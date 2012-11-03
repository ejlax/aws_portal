<?php
				require_once 'AWSSDKforPHP/sdk.class.php';
				$ec2 = new AmazonEC2();
				$ec2->set_hostname('ec2.us-east-1.amazonaws.com');
				
				$response = $ec2->describe_instances(array(
				'Filter' => array(
				array('Name' => 'tag:Name', 'Value' => 'CloudConnect-QA'),
				
				))); 
				print_r($response);
?>
