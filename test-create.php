<?php
if (empty($argv[1])) {
	print ("usage: $argv[0] <arg1> <arg2> ...\n");
	print ("    Args: machine_name AMI availability_zone instance_size key_pair machine_type_tag deployment_tag security_group\n");
	print (" EXAMPLE: test-99 ami-a9559ec0 us-east-1a m1.small private-key webserver temp webserver\n");
	print (" EXAMPLE: test-99 ami-bba4fbfe us-west-1a m1.small private-key worker temp internal\n");
	print ("\n");
	print ("    NOTE: WORKS IN EAST AND WEST ONLY!!\n");
	exit();
}

echo "\n";
echo "      Machine Name: $argv[1]\n";
echo "               AMI: $argv[2]\n";
echo " availability zone: $argv[3]\n";
echo "     instance size: $argv[4]\n";
echo "          key pair: $argv[5]\n";
echo "machine_type (TAG): $argv[6]\n";
echo "  deployment (TAG): $argv[7]\n";
echo "    security group: $argv[8]\n";
echo "\n";
echo "Are you sure you want to do this?  Type 'yes' to continue: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
if(trim($line) != 'yes'){
	    echo "ABORTING!\n";
	        exit;
}
echo "\n";
echo "continuing...\n";

        error_reporting(0);
        header("Content-type: text/html; charset=utf-8");
        require_once '../sdk.class.php';
        $ec2 = new AmazonEC2();
	if (!strncmp($argv[3],'us-west',7)) {
		$region_endpoint = 'ec2.us-west-1.amazonaws.com';
	}
	if (!strncmp($argv[3],'us-east',7)) {
		$region_endpoint = 'ec2.us-east-1.amazonaws.com';
	}
        $ec2->set_hostname($region_endpoint);
	$response = $ec2->run_instances($argv[2], 1, 1, array(
		'InstanceType' => $argv[4],
		'SecurityGroup' => $argv[8],
		'KeyName' => $argv[5],
		'Placement' => array (
			'AvailabilityZone' => $argv[3]
		)
	));
	if ($response->isOK()) {
		print ("SUCCESS submitting spinup request\n");
	} else {
		print ("FAILURE submitting spinup request\n");
		var_dump($response);
		exit();
	}
	$instance_id = (string) $response->body->instancesSet->item[0]->instanceId;
	echo ("Instance ID: $instance_id\n");

	$hostname = $argv[1];
	$response = $ec2->create_tags($instance_id, array(
		array('Key' => 'Name', 'Value' => $hostname),
		array('Key' => 'MachineType', 'Value' => $argv[6]),
		array('Key' => 'Deployment', 'Value' => $argv[7])
		));

	if ($response->isOK()) {
		print ("SUCCESS setting tags\n");
	} else {
		print ("FAILURE setting tags\n");
		var_dump($response);
		exit();
	}
?>