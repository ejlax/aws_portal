<?php
ob_start();
require_once 'AWSSDKforPHP/sdk.class.php';
//$file = $_GET['$file'];
$ec2 = new AmazonEC2();
$resource_id = $_POST['resource_id'];
$key = $_POST['keyName'];
$Value = $_POST['keyValue'];
//print_r($_POST);
$response = $ec2->create_tags($resource_id, array(
	'Key' => $key,
	'Value' => $Value
));
//print_r($response);
$status = $response->status;
if ($status = 200) {
	//print_r($response);
	echo "Key Pair, " . $key ."=". $Value ." was successfully created.";
	header('Refresh: 5;url=instances.php');
	}else{
		$error = $response->body->Errors->Error->message;
		echo $error;
	}
												
?>