// InvestGPT Chat Flow — логіка чату
// Всі шляхи відносні: ../api/openai.php

const API_URL = '../api/openai.php';
const DEMO_URL = '../demo/index.html';
const FORM_URL = '../index.php';

let leadCtxFull = {
	phase: 'chat',
	answers: {},
	auto_signals: {},
	utm: {},
	history: []
};

let fallbackMode = false;
let fallbackStep = 0;
const fallbackQuestions = [
	'Яка ваша головна фінансова ціль?',
	'Який ваш досвід інвестування?',
	'Який стартовий бюджет ви розглядаєте?',
	'Який рівень ризику для вас прийнятний?',
	'Який інструмент цікавить найбільше (крипто, форекс, акції, нерухомість)?'
];

function saveCtx() {
	sessionStorage.setItem('leadCtxFull', JSON.stringify(leadCtxFull));
	// leadCtx — скорочений для форми
	const leadCtx = {
		auto_signals: leadCtxFull.auto_signals,
		answers: leadCtxFull.answers,
		utm: leadCtxFull.utm,
		phase: leadCtxFull.phase
	};
	sessionStorage.setItem('leadCtx', JSON.stringify(leadCtx));
}

function addBubble(text, from) {
	const $b = $('<div>').addClass('bubble').addClass(from).text(text);
	$('#chat-bubbles').append($b);
	$('#chat-bubbles').scrollTop($('#chat-bubbles')[0].scrollHeight);
}

function setTyping(show) {
	$('#typing-indicator').toggle(show);
}

function clientSignals() {
	const ua = navigator.userAgent;
	const device = /Mobile|Android|iPhone|iPad|Opera Mini/i.test(ua) ? 'mobile' : 'desktop';
	const lang = (navigator.language || 'uk').slice(0,2);
	return { device, lang, user_agent: ua };
}

function startFallback() {
	fallbackMode = true;
	fallbackStep = 0;
	addBubble('Вітаємо! Відповідайте на кілька питань для персоналізації.', 'gpt');
	addBubble(fallbackQuestions[0], 'gpt');
}

function fallbackNext(userText) {
	if (fallbackStep < fallbackQuestions.length) {
		// Зберігаємо відповідь
		leadCtxFull.answers['q'+fallbackStep] = userText;
		fallbackStep++;
		if (fallbackStep < fallbackQuestions.length) {
			addBubble(fallbackQuestions[fallbackStep], 'gpt');
		} else {
			// Аналіз (спрощено)
			addBubble('Аналіз (спрощено): Ви маєте потенціал для інвестування. Пам’ятайте: це освітня симуляція, не є інвестпорадою.', 'gpt');
			addBubble('Перейти до демо-симуляції?', 'gpt');
			$('<button>').text('Перейти до демо').addClass('cta-btn').on('click', function(){
				window.location.href = DEMO_URL;
			}).appendTo($('#chat-bubbles'));
		}
		saveCtx();
	}
}

function handleReply(data) {
	if (data.reply) addBubble(data.reply, 'gpt');
	if (data.updates) {
		if (data.updates.answers) Object.assign(leadCtxFull.answers, data.updates.answers);
		if (data.updates.readiness_score) leadCtxFull.readiness_score = data.updates.readiness_score;
		if (data.updates.lead_tier) leadCtxFull.lead_tier = data.updates.lead_tier;
		if (data.updates.chance_range) leadCtxFull.chance_range = data.updates.chance_range;
		if (data.updates.segment) leadCtxFull.segment = data.updates.segment;
		if (data.updates.currency) leadCtxFull.currency = data.updates.currency;
	}
	if (data.demo && data.demo.asset) leadCtxFull.demo_asset = data.demo.asset;
	saveCtx();
	// Дії згідно action
	switch(data.action) {
		case 'goto_demo':
			$('<button>').text('Перейти до демо').addClass('cta-btn').on('click', function(){
				window.location.href = DEMO_URL + '?asset=' + encodeURIComponent(leadCtxFull.demo_asset||'BTC/UAH');
			}).appendTo($('#chat-bubbles'));
			break;
		case 'goto_form':
			window.location.href = FORM_URL;
			break;
		default:
			// ask, show_analysis, postdemo — просто показуємо reply
			break;
	}
}

function sendMessage(userText) {
	setTyping(true);
	if (userText && userText.trim().length>0) {
		addBubble(userText, 'user');
		leadCtxFull.history.push({role:'user', content:userText});
	}
	saveCtx();
	// Формуємо messages
	const messages = [
		...leadCtxFull.history,
		{role:'system', name:'client_auto_signals', content: JSON.stringify(clientSignals())}
	];
	$.ajax({
		url: API_URL,
		method: 'POST',
		contentType: 'application/json',
		data: JSON.stringify({messages}),
		dataType: 'json',
		timeout: 20000,
		success: function(data) {
			setTyping(false);
			if (data.error === 'NO_API_KEY' || data.error === 'OPENAI_ERROR') {
				startFallback();
				return;
			}
			if (data.reply) {
				leadCtxFull.history.push({role:'assistant', content:data.reply});
			}
			handleReply(data);
		},
		error: function() {
			setTyping(false);
			startFallback();
		}
	});
}

$(function(){
	// UTM
	const params = new URLSearchParams(window.location.search);
	['utm_source','utm_campaign','adset_id','ad_id','fbclid','pixel'].forEach(k=>{
		if(params.get(k)) leadCtxFull.utm[k]=params.get(k);
	});
	// Автосигнали
	leadCtxFull.auto_signals = clientSignals();
	saveCtx();

	// Привітання
	if (!leadCtxFull.history.length) {
		setTimeout(()=>{
			setTyping(true);
			setTimeout(()=>{
				setTyping(false);
				addBubble('Вітаємо! Я допоможу підібрати оптимальний сценарій інвестування. Відповідайте, будь ласка, на питання.', 'gpt');
				// Перше питання — через GPT
				sendMessage('');
			}, 800);
		}, 400);
	} else {
		// Відновлення історії
		leadCtxFull.history.forEach(msg=>{
			addBubble(msg.content, msg.role==='user'?'user':'gpt');
		});
	}

	$('#chat-form').on('submit', function(e){
		e.preventDefault();
		if (fallbackMode) {
			const val = $('#chat-input').val();
			if(val) fallbackNext(val);
			$('#chat-input').val('');
			return;
		}
		const val = $('#chat-input').val();
		if(val) sendMessage(val);
		$('#chat-input').val('');
	});
});
