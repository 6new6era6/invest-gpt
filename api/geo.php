<?php
// api/geo.php — JSON geo lookup via IP (server-side), no SSE; Keitaro-friendly
header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

// Do not expose secrets; use free endpoints without keys if possible
function client_ip(){
  foreach (['HTTP_CF_CONNECTING_IP','HTTP_X_FORWARDED_FOR','HTTP_X_REAL_IP','REMOTE_ADDR'] as $h){
    if (!empty($_SERVER[$h])){
      $ip = $_SERVER[$h];
      if (strpos($ip, ',') !== false) $ip = trim(explode(',', $ip)[0]);
      return $ip;
    }
  }
  return '0.0.0.0';
}

$ip = client_ip();
// Use ipapi.co (no key for basic fields); fallback to ipinfo.io/json which may rate-limit
$providers = [
  function($ip){
    $url = 'https://ipapi.co/'.urlencode($ip).'/json/';
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER=>true, CURLOPT_TIMEOUT=>3]);
    $res = curl_exec($ch); $err = curl_error($ch); curl_close($ch);
    if ($err || !$res) return null;
    $j = json_decode($res, true);
    if (!$j) return null;
    return [
      'ip' => $ip,
      'country' => $j['country_name'] ?? null,
      'country_code' => $j['country'] ?? null,
      'currency' => $j['currency'] ?? null,
      'lang_hint' => $j['languages'] ?? null,
      'ua' => $_SERVER['HTTP_USER_AGENT'] ?? ''
    ];
  },
  function($ip){
    $url = 'https://ipinfo.io/json';
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER=>true, CURLOPT_TIMEOUT=>3]);
    $res = curl_exec($ch); $err = curl_error($ch); curl_close($ch);
    if ($err || !$res) return null;
    $j = json_decode($res, true);
    if (!$j) return null;
    $cc = $j['country'] ?? null;
    $map = ['UA'=>'UAH','PL'=>'PLN','GB'=>'GBP','DE'=>'EUR','FR'=>'EUR','ES'=>'EUR','IT'=>'EUR','PT'=>'EUR','US'=>'USD','CA'=>'CAD','AU'=>'AUD'];
    return [
      'ip' => $ip,
      'country' => $j['country'] ?? null,
      'country_code' => $cc,
      'currency' => $map[$cc] ?? 'USD',
      'lang_hint' => null,
      'ua' => $_SERVER['HTTP_USER_AGENT'] ?? ''
    ];
  }
];

$result = null;
foreach ($providers as $fn){
  $result = $fn($ip);
  if ($result && !empty($result['country_code'])) break;
}
if (!$result) $result = ['ip'=>$ip, 'country'=>null, 'country_code'=>null, 'currency'=>null, 'ua'=>($_SERVER['HTTP_USER_AGENT'] ?? '')];

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
