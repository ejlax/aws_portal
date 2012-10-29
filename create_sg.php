<?php
include_once('verify.php');
require_once 'AWSSDKforPHP/sdk.class.php';
$ec2 = new AmazonEC2();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pearson AWS Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../aws_portal/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../aws_portal/img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../aws_portal/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../aws_portal/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../aws_portal/ico/apple-touch-icon-57-precomposed.png">

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">AWS Portal</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#"><i class="icon-home icon-black"></i>Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav pull-right">
            	<li class="dropdown">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="icon-user"></b>Welcome,&nbsp;<?php echo $name[firstName]."&nbsp".$name[lastName];?><b class="caret"></b></a>
              		<ul class="dropdown-menu">
						<li><a href='#'>Settings</a></li>  
		                <li><a href='#'>Profile</a></li>  
		                <li class='divider'></li>  
		                <li><a href='logout.php'>Logout</a></li>
              		</ul>
          		<li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Instances</li>
              <li><a href="instances.php">Create Instances</a></li>
              <li><a href="view_instances.php">View Instances</a></li>
              <li><a href="backups.php">Backup Instances</a></li>              
              <li class="nav-header">Security Groups and Volumes</li>
              <li class="active"><a href="securitygroups.php">Create Security Group</a></li>
              <li><a href="view_instances.php">View Security Groups</a></li>                
              <li><a href="ebsvolumes.php">Create Volumes</a></li>
              <li class="nav-header">Billings</li>                        
              <li><a href="#">MTD Costs</a></li>
              <li><a href="#">YTD Costs</a></li>
              <li><a href="#">Send Invoices</a></li>
              <li class="nav-header">Account</li>
              <li><a href="#">Profile</a></li>
              <li><a href="#">AWS Credentials</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
          <!--  <div class="hero-unit">
            <h1>AWS Instance List</h1>
            <p>Live list of all instances in AWS</p>
            <p><a class="btn btn-primary btn-large" href="//aws.amazon.com/what-is-aws/">Learn more &raquo;</a></p>
          </div>  -->
		<div class="span10 content">
        <!-- Main hero unit for a primary marketing message or call to action -->
        <!-- Tabs -->
          <h3>Services</h3>
          <div class="span10">
          <div class="tabbable tabs-left">
          	<ul class="span3 nav nav-tabs">
            <li><a href="#tab1" data-toggle="tab">Create Security Group</a></li>
            <li><a href="#tab2" data-toggle="tab">Edit Security Group</a></li>
          </ul>	
          <div>
          	<? $group_name = $_POST['group_name'];
				$group_description = $_POST['group_description'];
				$ip_source = $_POST['ip_source'];
				$fromPort = $_POST['fromPort'];
				$toPort = $_POST['toPort'];
				$IpProtocol = $_POST['IpProtocol'];
				$response = $ec2->create_security_group($group_name, $group_description);
					if (!$response->isOK())
			{
	if (((string) $response->body->Errors->Error->Code) === 'InvalidGroup.Duplicate')
	{
		// This means that the group is already created, so ignore.
		echo 'API call, create_security_group, returned an acceptable error: ' . $response->body->Errors->Error->Message . PHP_EOL;
	} else {
		$error = $response->body->Errors->Error->message;
		echo "Error: ";
		echo $error;
		exit();
		}
	}

// Open up ports for traffic to the associated IP
// from above (e.g. ssh traffic)
$ip_source = $_POST['ip_range'];
//$ip_source = '0.0.0.0/8';
//echo $ip_source."<p>";
$ingress_opt = array(
	'GroupName' => $group_name,
	'IpPermissions' => array(
		array(
			'IpProtocol' => $IpProtocol,
			'FromPort' => $fromPort,
			'ToPort' => $toPort,
			'IpRanges' => array(
				array('CidrIp' => $ip_source),
			)
    	)
	)
);

// Authorize the ports to be used.
$response = $ec2->authorize_security_group_ingress($ingress_opt);
if ($response->isOK()){
	$message = "Security Group was Successfully Created";
	echo $message;
	header("Refresh: 5;url=securitygroups.php");
}
if (!$response->isOK()) {
	if (((string) $response->body->Errors->Error->Code) === 'InvalidPermission.Duplicate') 
	{
		echo 'API call, authorize_security_group_ingress, returned an acceptable error: ' . $response->body->Errors->Error->Message . PHP_EOL;
		header("Refresh: 5;url=securitygroups.php");
	} else {
		echo "Error:";
		print_r($response);
		exit();
	}
}
?>
        	</div><!--/tabbable-->
        </div><!--/span-->
       </div>
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>


