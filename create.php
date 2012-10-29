<?php
ob_start();
require_once 'AWSSDKforPHP/sdk.class.php';
$ec2 = new AmazonEC2();
//Get data from HTTP GET
$image_id = $_POST['imageId'];
$instancetype = $_POST['instanceType'];
$region = $_POST['region'];
$securitygroup = $_POST['securityGroupName'];
$keyName = $_POST['keyPair'];
$ec2->set_hostname('ec2.us-east-1.amazonaws.com');
$response = $ec2->run_instances($image_id, 1, 1, array(
    InstanceType => $instancetype,
    KeyName => $keyName,
    SecurityGroupId => $securitygroup
	)
);
	if($response->isOK()) {
				$requestID = (string) $response->body->requestId;
				$instanceId = (string) $response->body->instancesSet->item->instanceId;
				$amiID = (string) $response->body->instancesSet->item->imageId;
				//$errorMessage = (string) $response->body->Errors->Error->Message;
				$imageId = (string) $item->instancesSet->item->imageId;
				//$instanceState = (string) $item->instancesSet->item->instanceState->name;
				$instanceType = (string) $response->body->instancesSet->item->instanceType;
				$instanceTime = (string) $response->body->instancesSet->item->launchTime;
				$instanceLoc = (string) $response->body->instancesSet->item->placement->availabilityZone;
				$platform = (string) $response->body->instancesSet->item->platform;
				$name = (string) $item->instancesSet->item->tagSet->item->value;
				header('location:instance_info.php?instanceId='.$instanceId);

	}else{
				$errorCode = (string) $response->body->Errors->Error->Code;
				$errorMessage = (string) $response->body->Errors->Error->Message;
				$requestID = (string) $response->body->RequestID;
				
			echo "Request, " . $requestID .", was unsuccessful. The error was: " . $errorMessage . " .";
			echo "<p>";
			//print_r($_POST);
			
	}
	exit();
	
?>


