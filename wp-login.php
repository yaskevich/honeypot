<?php 
// sudo apt-get install php5-sqlite
// print_r($_SERVER);

$headers =  getallheaders();
// foreach($headers as $key=>$val){
  // echo $key . ': ' . $val . '<br>';
// }

// $realip = $_SERVER['HTTP_CF_CONNECTING_IP'];
// echo '<br/><b>'.$realip.'</b>'.'<br/>';
// CREATE TABLE requests(
   // id INTEGER PRIMARY KEY AUTOINCREMENT, 
   // ip TEXT,
   // country TEXT,   
   // ray TEXT,   
   // ua TEXT,   
   // lang TEXT,
   // timedate DATETIME DEFAULT CURRENT_TIMESTAMP)

$ip =  isset($headers['CF-Connecting-IP']) ? $headers['CF-Connecting-IP']: '';
$country =  isset($headers['CF-IPCountry']) ? $headers['CF-IPCountry']: '';
$ray =  isset($headers['CF-RAY']) ? $headers['CF-RAY']: '';
$ua = isset($headers['user-agent']) ? $headers['user-agent']: '';
$lang  = isset($headers['accept-language']) ? $headers['accept-language']: '';
   
// echo $ip.'<br/>';
// echo $country.'<br/>';
// echo $ray.'<br/>';
// echo $ua.'<br/>';
// echo $lang.'<br/>';


// Host: sx.by
// Connection: Keep-Alive
// Accept-Encoding: gzip
// CF-IPCountry: DE
// X-Forwarded-For: 2a02:e00:ffec:27a:0:0:0:a
// CF-RAY: 3eeb04cc0f47729b-AMS
// X-Forwarded-Proto: https
// CF-Visitor: {"scheme":"https"}
// user-agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0
// accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
// accept-language: en-US,en;q=0.5
// dnt: 1
// upgrade-insecure-requests: 1
// cache-control: max-age=0
// cookie: __cfduid=daa74bc260981266d1cddb7ec57f3710e1518794216
// CF-Connecting-IP: 2a02:e00:ffec:27a:0:0:0:a
$db = new SQLite3("/data/www/stub/honey.db");
// $db->exec("INSERT INTO requests (ip, country, ray, ua, lang) VALUES ($ip, $country, $ray, $ua,  $lang)");
$stmt = $db->prepare("INSERT INTO requests (ip, country, ray, ua, lang) VALUES (?,?,?,?,?)");
// $stmt->bind_param('sssss',$ip, $country, $ray, $ua,  $lang);
$stmt->bindValue(1, $ip, SQLITE3_TEXT);
$stmt->bindValue(2, $country, SQLITE3_TEXT);
$stmt->bindValue(3, $ray, SQLITE3_TEXT);
$stmt->bindValue(4, $ua, SQLITE3_TEXT);
$stmt->bindValue(5, $lang, SQLITE3_TEXT);
// $stmt->bindValue(2, 42, SQLITE3_INTEGER);
$stmt->execute();
$stmt->close();

?>