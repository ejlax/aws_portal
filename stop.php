<?php
require_once 'AWSSDKforPHP/sdk.class.php';
$file = $_GET['$file'];
$ec2 = new AmazonEC2();
if(isset($_GET['instanceId'])){
$instance_id = $_GET['instanceId'];
$response = $ec2->stop_instances($instance_id);
$status = $response->status;
if ($status = 200) {
	header('location:instance_info.php?instanceId='.$instance_id);
}else{
	$error = $response->body->Errors->Error->message;
	echo $error;
}
//print_r($response);
//foreach ($response->body->reservationSet->item as $item) {
	//$instanceId = (string) $item->instancesSet->item->instanceId;
	//$name = (string) $item->instancesSet->item->tagSet->item->value;
	//echo "<option value=". $instanceId . ">" . $name . " " . $instanceId . "</option>";							
}						
?>