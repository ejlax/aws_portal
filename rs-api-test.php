<?php
require_once('AWSSDKforPHP/rs-api-creds.php');
/*$rs_api = array(
	'version' => '1.0',
	'account_id' => 46971,
	'username' => "eric.adams@pearson.com",
	'password' => "g0r3ds0x!",
	'cookie_file' => 'tmp/rs_api_cookie.txt',
	//'cookie_file' => tempnam("/tmp", "rs_api"),
);*/

$rs_api['url'] = "https://my.rightscale.com/api/acct/".$rs_api['account_id'];

$rs_api['login_url'] = $rs_api['url']."/login?api_version=".$rs_api['version'];

$ch = curl_init($rs_api['login_url']);

curl_setopt($ch, CURLOPT_COOKIEJAR, $rs_api['cookie_file']);
curl_setopt($ch, CURLOPT_USERPWD,$rs_api['username'].':'.$rs_api['password']);

curl_exec($ch);
curl_close($ch);

$url = $rs_api['url']."/servers?api_version=".$rs_api['version'];
$header = 'X-API-VERSION: 1.0';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_COOKIEFILE, $rs_api['cookie_file']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$xml = new SimpleXMLElement( curl_exec($ch));
curl_close($ch);

//print_r($xml);
$i=0;
//$servers = $xml->server->children();

//print_r($xml['server']);
echo "Start Server: </p>
	<form method='get' action='rs-api-start.php'>
	<select name='serverid[]' multiple='multiple'>";
foreach($xml->server as $server){
	$i++;
	$nickname = (string) $server->nickname;
	$url = (string) $server->href;
	//$depl = (string) $server->deployment-href;
	$servers = explode('servers/', $url);
	$serverid = $servers[1];
	echo "<option value='" .$serverid ."'>" .$nickname ."</option>";
		
}
echo "</select></br>
<select name='type'>
<option value='stop'>Stop</option>
<option value='start'>Start</option>
</select>
<input type='submit' value='submit' name='submit'>";

//print_r($_GET);
?>