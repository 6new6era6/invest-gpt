// js/chat_flow.js — JSON клієнт (без SSE)
(function(){
	const chat  = document.getElementById('chat') || document.getElementById('chat-bubbles');
	const input = document.getElementById('chat-input');
	const send  = document.getElementById('chat-send');
	const context = { messages: [], model: 'gpt-4o-mini' };

	function typeMessage(text, el, speed = 24) {
		return new Promise(resolve => {
			let i = 0; el.textContent = '';
			const t = setInterval(() => {
				el.textContent += text[i] ?? '';
				i++; chat.scrollTop = chat.scrollHeight;
				if (i >= text.length) { clearInterval(t); resolve(); }
			}, speed);
		});
	}
	async function appendMessage(text, cls = 'bot', animate = true) {
		const el = document.createElement('div');
		el.className = `bubble ${cls}`;
		chat.appendChild(el);
		if (animate && cls === 'bot') await typeMessage(text, el);
		else el.textContent = text;
		chat.scrollTop = chat.scrollHeight;
		return el;
	}
	function showTyping() {
		const el = document.createElement('div');
		el.className = 'typing-indicator';
		el.innerHTML = '<span></span><span></span><span></span>';
		chat.appendChild(el);
		chat.scrollTop = chat.scrollHeight;
		return el;
	}
	function applyUpdates(upd) {
		try {
			const st = JSON.parse(sessionStorage.leadCtx || '{"answers":{}}');
			const ans = { ...(st.answers || {}), ...((upd && upd.answers) || {}) };
			const merged = { ...st, ...upd, answers: ans };
			sessionStorage.leadCtx = JSON.stringify(merged);
		} catch(_) {}
	}
	function pickDefaultAsset() {
		try {
			const st = JSON.parse(sessionStorage.leadCtx || '{}');
			const curr = st.currency || st.auto_signals?.currency || 'USD';
			return `BTC/${curr}`;
		} catch(_){ return 'BTC/USD'; }
	}
	function showDemoButton(asset) {
		const wrap = document.createElement('div');
		wrap.style.marginTop = '8px';
		const btn = document.createElement('button');
		btn.className = 'cta';
		btn.textContent = 'Перейти до демо';
		btn.onclick = () => {
			const q = asset ? `?asset=${encodeURIComponent(asset)}` : '';
			window.location.href = `../demo/index.html${q}`;
		};
		wrap.appendChild(btn);
		chat.appendChild(wrap);
		chat.scrollTop = chat.scrollHeight;
	}
	async function askOpenAI(userText) {
		context.messages.push({ role: 'user', content: userText });
		const typing = showTyping();
		try {
			const ac = new AbortController();
			const tid = setTimeout(()=>ac.abort(), 30000);
			const res = await fetch('../api/openai.php', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(context),
				signal: ac.signal
			});
			clearTimeout(tid);
			typing.remove();
			if (!res.ok) throw new Error(`HTTP ${res.status}`);
			const data = await res.json();
			if (data.error === 'NO_API_KEY') {
				return await fallbackFlow(userText);
			}
			const reply  = (data.reply ?? '').toString();
			const action = (data.action ?? 'ask').toString();
			const updates = data.updates || {};
			const demo = data.demo || {};
			if (reply) {
				await appendMessage(reply, 'bot', true);
				context.messages.push({ role: 'assistant', content: reply });
			}
			applyUpdates(updates);
			switch (action) {
				case 'goto_demo':
					showDemoButton(demo.asset || pickDefaultAsset());
					break;
				case 'goto_form':
					window.location.href = '../index.php';
					break;
			}
		} catch (e) {
			typing.remove();
			console.error(e);
			await appendMessage('Вибачте, сталася помилка. Спробуйте ще раз.', 'bot');
		}
	}
	// Fallback (якщо немає ключа/мережа впала)
	const fbQ = [
		'Яка ваша головна мета на 1–3 роки?',
		'На який горизонт плануєте?',
		'Рівень ризику?',
		'Сума для старту?',
		'Що цікавить: крипта/акції/FX/індекси?'
	];
	let fbI = 0;
	async function fallbackFlow() {
		if (fbI >= fbQ.length) {
			await appendMessage('Аналіз (спрощено): оцінний шанс 55–75%. Перейдемо до демо?', 'bot', true);
			showDemoButton(pickDefaultAsset());
			return;
		}
		await appendMessage(fbQ[fbI++], 'bot', true);
	}
	// Події
	send.addEventListener('click', async () => {
		const message = input.value.trim();
		if (!message) return;
		input.value = '';
		await appendMessage(message, 'user', false);
		askOpenAI(message);
	});
	input.addEventListener('keypress', e => {
		if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); send.click(); }
	});
})();
