// Рендер аналізу відповідей з sessionStorage.leadCtx
$(function(){
	let ctx = {};
	try {
		ctx = JSON.parse(sessionStorage.getItem('leadCtx')||'{}');
	} catch(e) {}
	const a = ctx.answers || {};
	const card = [
		a.goal ? `<div><b>Ціль:</b> ${a.goal}</div>` : '',
		a.horizon ? `<div><b>Горизонт:</b> ${a.horizon}</div>` : '',
		a.experience ? `<div><b>Досвід:</b> ${a.experience}</div>` : '',
		a.risk ? `<div><b>Ризик:</b> ${a.risk}</div>` : '',
		a.start_budget ? `<div><b>Стартовий бюджет:</b> ${a.start_budget}</div>` : '',
		a.instruments ? `<div><b>Інструменти:</b> ${a.instruments}</div>` : '',
		a.lifestyle_auto ? `<div><b>Авто:</b> ${a.lifestyle_auto}</div>` : '',
		a.lifestyle_vacation ? `<div><b>Відпустка:</b> ${a.lifestyle_vacation}</div>` : '',
		a.housing ? `<div><b>Житло:</b> ${a.housing}</div>` : '',
		ctx.readiness_score ? `<div><b>Готовність:</b> ${ctx.readiness_score}</div>` : '',
		ctx.lead_tier ? `<div><b>Tier:</b> ${ctx.lead_tier}</div>` : '',
		ctx.chance_range ? `<div><b>Оцінний діапазон шансів:</b> ${ctx.chance_range}</div>` : '',
		ctx.segment ? `<div><b>Сегмент:</b> ${ctx.segment}</div>` : '',
		ctx.currency ? `<div><b>Валюта:</b> ${ctx.currency}</div>` : ''
	].filter(Boolean).join('');
	$('#analysis-card').html(card || '<i>Недостатньо даних для аналізу.</i>');
	// Кнопка демо
	$('#goto-demo').on('click', function(){
		let asset = ctx.demo_asset || (ctx.segment==='fx' ? 'EUR/PLN' : 'BTC/'+(ctx.currency||'UAH'));
		window.location.href = '../demo/index.html?asset='+encodeURIComponent(asset);
	});
});
