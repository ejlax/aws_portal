<?php
require_once 'AWSSDKforPHP/sdk.class.php';
$file = $_GET['$file'];
$ec2 = new AmazonEC2();
$filename = 'PS_EC2_QA.pem';
if(isset($_GET['instanceId'])){
	$instance_id = $_GET['instanceId'];
	$response = $ec2->get_password_data($instance_id, array(
	'DecryptPasswordWithKey' => file_get_contents('PearsonDataSolutions-QA.pem')
	)
);
$status = $response->status;
if ($status == 200 ) {
	$password = (string) $response->body->passwordData;
	header('location:instance_info.php?instanceId='.$instance_id.'&winpass='.$password);
}else{
	$error = $response->body->Errors->Error->message;
		echo $error;
}	
}												
?>