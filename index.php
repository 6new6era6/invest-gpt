<!DOCTYPE html>
<html lang="uk">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>InvestGPT Funnel — Форма заявки</title>
	<link rel="icon" href="images/favicon.ico">
	<link rel="stylesheet" href="css/flow.css">
	<link rel="stylesheet" href="css/funnel.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/handoff.js"></script>
</head>
<body>
	<div class="form-container">
		<h2>Залиште заявку</h2>
		<form id="lead-form" method="post" action="formproccesingforexpartners_upd/index.php">
			<div class="form-group">
				<label for="name">Ім'я</label>
				<input type="text" id="name" name="name" required>
			</div>
			<div class="form-group">
				<label for="last">Прізвище</label>
				<input type="text" id="last" name="last" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" required>
			</div>
			<div class="form-group">
				<label for="prephone">Телефон</label>
				<input type="tel" id="prephone" name="prephone" required>
			</div>
			<div class="form-group">
				<input type="checkbox" id="terms" name="terms" required>
				<label for="terms">Я погоджуюсь з <a href="terms/index.html" target="_blank">умовами</a> та <a href="privacy/index.html" target="_blank">політикою</a></label>
			</div>
			<!-- Hidden поля для leadCtx -->
			<input type="hidden" name="lead_ctx" id="lead_ctx">
			<input type="hidden" name="goal" id="goal">
			<input type="hidden" name="horizon" id="horizon">
			<input type="hidden" name="experience" id="experience">
			<input type="hidden" name="risk" id="risk">
			<input type="hidden" name="lifestyle_auto" id="lifestyle_auto">
			<input type="hidden" name="lifestyle_vacation" id="lifestyle_vacation">
			<input type="hidden" name="housing" id="housing">
			<input type="hidden" name="start_budget" id="start_budget">
			<input type="hidden" name="instruments" id="instruments">
			<input type="hidden" name="readiness_score" id="readiness_score">
			<input type="hidden" name="lead_tier" id="lead_tier">
			<input type="hidden" name="chance_range" id="chance_range">
			<input type="hidden" name="segment" id="segment">
			<input type="hidden" name="currency" id="currency">
			<input type="hidden" name="demo_amount" id="demo_amount">
			<input type="hidden" name="device" id="device">
			<input type="hidden" name="lang" id="lang">
			<input type="hidden" name="utm_source" id="utm_source">
			<input type="hidden" name="utm_campaign" id="utm_campaign">
			<input type="hidden" name="adset_id" id="adset_id">
			<input type="hidden" name="ad_id" id="ad_id">
			<input type="hidden" name="fbclid" id="fbclid">
			<input type="hidden" name="pixel" id="pixel">
			<button type="submit" class="cta-btn">Відправити заявку</button>
		</form>
		<div class="disclaimer">Освітня симуляція. Не є інвестпорадою.</div>
	</div>
	<script>
	$(function(){
		$('#lead-form').validate();
	});
	</script>
</body>
</html>
