    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reveal.css">
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" />
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
    <script type="text/javascript" src="Source/UI/Bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.reveal.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/mootools_and_boostrap.js"></script>
	
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
      <body>
    <div class="topbar">
      <div class="topbar-inner" data-behavior="BS.Dropdown">
        <div class="container-fluid">
          <a class="brand" href="home.php">Pearson AWS Portal</a>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
   			<li class="menu pull-right">
   				<a class="pull-right menu" href='#'>Welcome, <?php echo $name[firstName]."&nbsp".$name[lastName];?><b class="caret"</b></a>
			<ul class="menu-dropdown pull-right">
				<li><a href='#'>Settings</a></li>  
                <li><a href='#'>Profile</a></li>  
                <li class='divider'></li>  
                <li><a href='logout.php'>Logout</a></li>
			</ul>
			</li>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="sidebar">
        <div class="well">
          <h5>Instances</h5>
          <ul>
            <li><a href="aws-sdk.php"><b>Create Instances</b></a></li>
            <li><a href="view_instances.php">View Instances</a></li>
          </ul>
          <h5>Billing</h5>
          <ul>
            <li><a href="#">View MTD Billing</a></li>
            <li><a href="#">View YTD Billing</a></li>
            <li><a href="#">Send Billing</a></li>
          </ul>
          <h5>Account</h5>
          <ul>
            <li><a href="#">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
      <div class="content">
        <!-- Tabs -->
                  <h3>Services</h3>
          <ul data-bs-tabs-options="{}" class="tabs" data-behavior="BS.Tabs">
            <li class="active"><a href="#aws_ec2">Create Instance</a></li>
            <li><a >Stop Instance</a></li>
            <li><a>Create and Attach Volume</a></li>
          </ul>
          <div id="my-tab-content" class="tab-content">
            <div style="display: block; overflow: visible;" class="active" id="aws_ec2">
              <p>
              	<form class="form-stacked">
				  <div class="control-group">
				    <label class="control-label" for="inputEmail">Email</label>
				    <div class="controls">
				      <input type="text" id="inputEmail" placeholder="Email">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="inputPassword">Password</label>
				    <div class="controls">
				      <input type="password" id="inputPassword" placeholder="Password">
				    </div>
				  </div>
				  <div class="control-group">
				    <div class="controls">
				      <label class="checkbox">
				        <input type="checkbox"> Remember me
				      </label>
				      <button type="submit" class="btn">Sign in</button>
				    </div>
				  </div>
				</form>
			   </p>
            </div>
            <div id="stop_instances">
            	<p>

                </p>	
            </div>
            <div id="create_volumes">
              <p>
              	
              </p>
            </div>
         </div>
        </div>
       </div>
<!--  <?php
// For AWS PHP SDK
require_once 'AWSSDKforPHP/sdk.class.php';
/* Get data from HTTP POST
$ami = 'ami-d8699bb1';
$instancetype = 't1.micro';
$keyname = $_POST['key'];
$securitygroup = 'default';
 * 
 */
 
// Create the AmazonEC2 object so we can call various APIs.
$ec2 = new AmazonEC2();

/* Create a new security group.
$response = $ec2->create_security_group ( 'GettingStartedGroup', 'Getting Started Security Group');
if (!$response->isOK())
{
	if (((string) $response->body->Errors->Error->Code) === 'InvalidGroup.Duplicate')
	{
		// This means that the group is already created, so ignore.
		echo 'create_security_group returned an acceptable error: ' . $response->body->Errors->Error->Message . PHP_EOL;
	} else {
		print_r($response);
		exit();
	}
}

// TODO - Change the code below to use your external ip address. 
$ip_source = '0.0.0.0/0';

// Open up port 22 for TCP traffic to the associated IP
// from above (e.g. ssh traffic).
$ingress_opt = array(
	'GroupName' => 'GettingStartedGroup',
	'IpPermissions' => array(
		array(
			'IpProtocol' => 'tcp',
			'FromPort' => '22',
			'ToPort' => '22',
			'IpRanges' => array(
				array('CidrIp' => $ip_source),
			)
    )
	)
);

// Authorize the ports to be used.
$response = $ec2->authorize_security_group_ingress($ingress_opt);
if (!$response->isOK()) 
{
	if (((string) $response->body->Errors->Error->Code) === 'InvalidPermission.Duplicate') 
	{
		echo 'authorize_security_group_ingress returned an acceptable error: ' .$response->body->Errors->Error->Message .PHP_EOL;
	} else {
		print_r($response);
		exit();
	}
}
*/
// Setup the specifications of the launch. This includes the
// instance type (e.g. t1.micro) and the latest Amazon Linux
// AMI id available. Note, you should always use the latest
// Amazon Linux AMI id or another of your choosing.
$response = $ec2->run_instances('ami-84db39ed', 1, 1, array(
    'InstanceType' => 't1.micro'
));
	if ($response->isOK()) {
				$ec2->set_hostname('ec2.us-east-1.amazonaws.com');
				//$instances = array();	
				echo "<table align='center'>";
				echo "<r> <td><b>Request&nbspID</b></td></td></td><td>Name<b></b></td><td><b>InstanceID</b></td><td>AMI&nbspID<b></b></td></td><td>AZ<b></b></td>";
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
				//$stopped = (string) $item->instancesSet->item->reason;
				
				
				echo '<tr> <td> ' . $requestID . ' </td> <td>' . $name . '</td> <td>' . $instanceId . '</td><td>'. $amiID . '</td><td>'. $instanceLoc . '</td></tr>';
			echo "</div>";

	}else{
		echo "<div class='condensed-table'>";	
				$ec2->set_hostname('ec2.us-east-1.amazonaws.com');
				//$instances = array();	
				echo "<table align='center'>";
				echo "<r> <td><b>Request&nbspID</b></td><td><b>Error&nbspMessage</b></td><td>Error&nbspCode<b></b></td>";
				$errorCode = (string) $response->body->Errors->Error->Code;
				$errorMessage = (string) $response->body->Errors->Error->Message;
				$requestID = (string) $response->body->RequestID;
				
				echo '<tr> <td> ' . $requestID . ' </td> <td>' . $errorMessage . '</td> <td>' . $errorCode . '</td></tr>';
			echo "</div>";				
	}
	exit();

/*$spot_instance_request_ids = array();
for ($i=0; $i < $response->body->spotInstanceRequestSet->item->count(); $i++) 
{
	$spot_instance_request_id = (string)$response->body->spotInstanceRequestSet->item[$i]->spotInstanceRequestId;
	$spot_instance_request_ids[] = $spot_instance_request_id;
}

// Initialize a variable that will track whether there are any
// requests still in the open state.
$any_open = false;

// Initialize an array to hold any instances we activate so we can terminate them later.
$instance_ids = array();

do {
	// Call describe_spot_instance_requests with all of the request ids to
	// monitor (e.g. that we started).
	$describe_opt = array(
		'SpotInstanceRequestId' => $spot_instance_request_ids
	);
	$response = $ec2->describe_spot_instance_requests($describe_opt);		
	if (!$response->isOK()) 
	{
		print_r($response);
		exit();
	}

	// Reset the any_open variable to false - which assumes there
	// are no requests open unless we find one that is still open.
	$any_open = false;

	// Look through each request and determine if they are all in
	// the active state.
	foreach ($response->body->spotInstanceRequestSet->item as $item) 
	{
		echo "spotInstanceRequestId = $item->spotInstanceRequestId, state = $item->state" . PHP_EOL;
		
		// If the state is open, it hasn't changed since we attempted
		// to request it. There is the potential for it to transition
		// almost immediately to closed or cancelled so we compare
		// against open instead of active.
		if (((string)$item->state) === 'open') 
		{
			$any_open = true;
			break;
		}
		
		if (((string)$item->state) === 'active') 
		{
			// Get the instanceId once the spot instance request is active
			$instance_id = (string)$item->instanceId;
			echo 'Instance'.$instanceId.' is active.' . PHP_EOL;
			
			// Store the instanceId for any instances we've started so we can terminate them later.
			if (!in_array($instanceId, $instanceIds)) 
			{
				$instance_ids[] = (string)$item->instanceId;
			}
		}
	}
	
	if ($any_open) 
	{
		echo 'Requests still in open state, will retry in 60 seconds.' . PHP_EOL;
		sleep(60);
	}
} 
while($any_open);*/
?>  -->
     <script>
    var behavior = new Behavior().apply(document.body);
    var delegator = new Delegator({
      getBehavior: function(){ return behavior; }
    }).attach(document.body);
  </script>

