<?php
require_once 'AWSSDKforPHP/sdk.class.php';
$file = $_GET['$file'];
$ec2 = new AmazonEC2();
if(isset($_GET['instanceId'])){
$instance_id = $_GET['instanceId'];
$response = $ec2->reboot_instances($instance_id);
$status = $response->status;
if ($status = 200) {
	header('location:instance_info.php?instanceId='.$instance_id);
	}else{
		$error = $response->body->Errors->Error->message;
		echo $error;
	}
}													
?>