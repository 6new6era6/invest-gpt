
<?php
header('Content-Type: application/json; charset=utf-8');
// 1. Перевірка ключа (ENV → openai_key.php → /.openai_key)
function get_openai_key() {
	$env = getenv('OPENAI_API_KEY');
	if ($env && strpos($env, 'sk-') === 0) return trim($env);
	$keyfile = __DIR__ . '/openai_key.php';
	if (file_exists($keyfile)) {
		$key = include $keyfile;
		if ($key && strpos($key, 'sk-') === 0) return trim($key);
	}
	$rootkey = dirname(__DIR__, 1) . '/.openai_key';
	if (file_exists($rootkey)) {
		$key = trim(file_get_contents($rootkey));
		if (strpos($key, 'sk-') === 0) return $key;
	}
	return null;
}

$api_key = get_openai_key();
if (!$api_key) {
	echo json_encode(["error" => "NO_API_KEY"]);
	exit;
}

// 2. Прийом даних
$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input) || !isset($input['messages'])) {
	echo json_encode(["error" => "NO_MESSAGES"]);
	exit;
}

// 3. Сигнали сервера
$server_signals = [
	'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
	'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
	'device' => (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/Mobile|Android|iPhone|iPad|Opera Mini/i', $_SERVER['HTTP_USER_AGENT'])) ? 'mobile' : 'desktop',
];

// 4. System prompt (українською, суворо JSON, без гарантій)
$system_prompt = <<<EOT
Ти — AI-аналітик, керуєш воронкою (опитування→аналіз→демо→постдемо→форма).
Відповідаєш СТРОГО JSON-ом за схемою (див. нижче). Ніякого plain text.
Враховуєш server_signals (ip/ua/device) та client_auto_signals (device/lang/user_agent) для персоналізації, але не показуєш їх у тексті.
Не даєш фінансових гарантій; тільки «оцінний діапазон», «симуляція», «не гарантія».
Мова — українська.
Схема відповіді:
{
	"reply": "рядок — відповідь для користувача (укр)",
	"action": "ask | show_analysis | goto_demo | postdemo | goto_form",
	"updates": {
		"answers": { "goal": "", "horizon": "", "experience": "", "risk": "", "start_budget": "", "instruments": "", "lifestyle_auto": "", "lifestyle_vacation": "", "housing": "" },
		"readiness_score": 0,
		"lead_tier": "A|B|C",
		"chance_range": "70–95%",
		"segment": "crypto|fx|stocks|re",
		"currency": "UAH|PLN|USD|EUR|TRY"
	},
	"demo": { "asset": "BTC/UAH" }
}
EOT;

// 5. Додаємо system/system developer
$messages = $input['messages'];
array_unshift($messages, [
	'role' => 'system',
	'content' => $system_prompt
]);
array_unshift($messages, [
	'role' => 'system',
	'name' => 'developer',
	'content' => json_encode(['server_signals' => $server_signals])
]);

$model = isset($input['model']) ? $input['model'] : 'gpt-4o-mini';

// 6. Виклик OpenAI (без stream)
$payload = [
	'model' => $model,
	'messages' => $messages,
	'temperature' => 0.7,
	'max_tokens' => 512,
	'response_format' => ["type" => "json_object"]
];

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Content-Type: application/json',
	'Authorization: Bearer ' . $api_key
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$result = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 7. Обробка відповіді
if ($httpcode !== 200 || !$result) {
	echo json_encode(["error" => "OPENAI_ERROR", "httpcode" => $httpcode]);
	exit;
}
$data = json_decode($result, true);
if (!isset($data['choices'][0]['message']['content'])) {
	echo json_encode(["error" => "NO_CONTENT", "raw" => $data]);
	exit;
}
$content = $data['choices'][0]['message']['content'];

// 8. Перевірка на валідний JSON
$json = json_decode($content, true);
if (is_array($json) && isset($json['reply']) && isset($json['action'])) {
	echo json_encode($json, JSON_UNESCAPED_UNICODE);
	exit;
}
// Якщо plain text — загорнути у { reply: ..., action: "ask" }
echo json_encode([
	"reply" => $content,
	"action" => "ask"
], JSON_UNESCAPED_UNICODE);
exit;
