// Перенос sessionStorage.leadCtx у hidden-поля форми
$(function(){
	let ctx = {};
	try { ctx = JSON.parse(sessionStorage.getItem('leadCtx')||'{}'); } catch(e){}
	if (!ctx) ctx = {};
	// Основне поле
	$('#lead_ctx').val(sessionStorage.getItem('leadCtx')||'');
	// answers
	const a = ctx.answers||{};
	$('#goal').val(a.goal||'');
	$('#horizon').val(a.horizon||'');
	$('#experience').val(a.experience||'');
	$('#risk').val(a.risk||'');
	$('#lifestyle_auto').val(a.lifestyle_auto||'');
	$('#lifestyle_vacation').val(a.lifestyle_vacation||'');
	$('#housing').val(a.housing||'');
	$('#start_budget').val(a.start_budget||'');
	$('#instruments').val(a.instruments||'');
	// інші
	$('#readiness_score').val(ctx.readiness_score||'');
	$('#lead_tier').val(ctx.lead_tier||'');
	$('#chance_range').val(ctx.chance_range||'');
	$('#segment').val(ctx.segment||'');
	$('#currency').val(ctx.currency||'');
	// demo_amount: беремо з прямого поля або з demo.selectedAmount
	var demoAmt = ctx.demo_amount || (ctx.demo && ctx.demo.selectedAmount);
	$('#demo_amount').val(demoAmt||'');
	// авто-сигнали
	if(ctx.auto_signals) {
		$('#device').val(ctx.auto_signals.device||'');
		$('#lang').val(ctx.auto_signals.lang||'');
	}
	// utm
	const utm = ctx.utm||{};
	$('#utm_source').val(utm.utm_source||'');
	$('#utm_campaign').val(utm.utm_campaign||'');
	$('#adset_id').val(utm.adset_id||'');
	$('#ad_id').val(utm.ad_id||'');
	$('#fbclid').val(utm.fbclid||'');
	$('#pixel').val(utm.pixel||'');
});
