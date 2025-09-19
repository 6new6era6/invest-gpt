<?php
header('Content-Type: text/html; charset=utf-8');
// Простий приймач форми — імітація успішного прийому для уникнення 404.
// У продакшені інтегруйте з реальним партнерським endpoint.
?>
<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="UTF-8">
<title>Заявку отримано</title>
<link rel="stylesheet" href="../css/flow.css">
<link rel="stylesheet" href="../css/funnel.css">
</head>
<body>
<div class="form-container">
  <h2>Дякуємо! Заявку отримано.</h2>
  <p>Наш менеджер зв’яжеться з вами найближчим часом.</p>
  <div class="disclaimer">Освітня симуляція. Не є інвестпорадою.</div>
</div>
</body>
</html>
