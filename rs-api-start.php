<?php

$rs_api = array(
	'version' => '1.0',
	'account_id' => 46971,
	'username' => "eric.adams@pearson.com",
	'password' => "g0r3ds0x!",
	'cookie_file' => 'tmp/rs_api_cookie.txt',
	//'cookie_file' => tempnam("/tmp", "rs_api"),
);

$rs_api['url'] = "https://my.rightscale.com/api/acct/".$rs_api['account_id'];

$rs_api['login_url'] = $rs_api['url']."/login?api_version=".$rs_api['version'];

$ch = curl_init($rs_api['login_url']);

curl_setopt($ch, CURLOPT_COOKIEJAR, $rs_api['cookie_file']);
curl_setopt($ch, CURLOPT_USERPWD,$rs_api['username'].':'.$rs_api['password']);

curl_exec($ch);
curl_close($ch);
//var_dump($_GET);

$serv = array(
	0 => '420241001',
	1 => '569036001'
	);
//print_r($serv);	

foreach($serv as $serverid){
$url = $rs_api['url']."/servers/". $serverid."/start_ebs";

$header = 'X-API-VERSION: 1.0';
$ch = curl_init($url);


curl_setopt($ch, CURLOPT_COOKIEFILE, $rs_api['cookie_file']);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "api_version=1.0");



$output = curl_exec($ch);
curl_close($ch);

echo $output;
}

?>


