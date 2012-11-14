<?php
require_once 'AWSSDKforPHP/sdk.class.php';
//$file = $_GET['$file'];
$ec2 = new AmazonEC2();
$instanceId = 'i-33298d4f';
// Describe the running instance to get the Availability Zone
$describe = $ec2->describe_instances($instanceId);
 
// Grab the Availability Zone
$avail_zone = (string) $describe->body->availabilityZone(0); // First result of the built-in XPath search.

$response = $ec2->create_volume($avail_zone, array(
    'Size' => 10 // Gibibytes
));
$status = $response->status;
if ($status = 200) {
	print_r($response);
	}else{
		$error = $response->body->Errors->Error->message;
		print_r($response);
	}
												
?>