<?php
ob_start();
require_once 'AWSSDKforPHP/sdk.class.php';
//$file = $_GET['$file'];
$instanceId = $_POST['instanceId'];
$size = $_POST['size'];
$key = $_POST['key'];
$value = $_POST['value'];
$ec2 = new AmazonEC2();
// Describe the running instance to get the Availability Zone
$describe = $ec2->describe_instances($instanceId);
 
// Grab the Availability Zone
$avail_zone = (string) $describe->body->availabilityZone(0); // First result of the built-in XPath search.
 
// Create the volume
$response = $ec2->create_volume($avail_zone, array(
    'Size' => $size // Gibibytes
));
 
// Success?
if($response->isOK()){
	echo "Volume was created successfully";
	$volume_id = $response->body->volumeId;
	print_r($response);
//Add Name to the Volume
	$response = $ec2->create_tags($volume_id, array(
	'Key' => $key,
	'Value' => $value
	));
	if($response->isOK()){
		echo "Tag was successfully created";
		header('Refresh: 5;url=instances.php');
	
		}else{
		print_r($response);
		exit();
		}
}
?>
