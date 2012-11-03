<?php
include_once('verify.php');
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
              <!--  <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>  -->
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
              <li class='active'><a href="view_instances.php">View Instances</a></li>
              <li><a href="backups.php">Backup Instances</a></li>              
              <li class="nav-header">Security Groups and Volumes</li>
              <li><a href="securitygroups.php">Create Security Group</a></li>
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
        <div class="span10">
          <div class="hero-unit">
            <h1>AWS Instance List</h1>
            <p>Live list of all instances in AWS</p>
            <p><a class="btn btn-primary btn-large" href="//aws.amazon.com/what-is-aws/">Learn more &raquo;</a></p>
          </div>
          <div>
          				<h3>Instances</h3>
          </div>
		<div class="table" id="instances">

          <?php
				require_once 'AWSSDKforPHP/sdk.class.php';
				$ec2 = new AmazonEC2();
				$ec2->set_hostname('ec2.us-east-1.amazonaws.com');
				$response = $ec2->describe_instances();

				/*%******************************************************************************************%*/
				
				$instances = array();	
				echo "<table id='instances' class='table-condensed table-bordered table-striped table-hover' align='center'>";
				echo "<thead><tr class='info'><th>Instance&nbsp;Name</th><th>InstanceId</th><th>AMI&nbsp;ID</th><th>InstanceState</th><th>InstanceType</th><th>InstanceTime</th><th>Time&nbspStopped</th><th>AZ</th><th>OS</td>";
				echo "<tbody>";
				foreach($response->body->reservationSet->item as $item){
					$instanceId = (string) $item->instancesSet->item->instanceId;
					$imageId = (string) $item->instancesSet->item->imageId;
					$instanceState = (string) $item->instancesSet->item->instanceState->name;
					$instanceType = (string) $item->instancesSet->item->instanceType;
					$instanceTime = (string) $item->instancesSet->item->launchTime;
					$instanceLoc = (string) $item->instancesSet->item->placement->availabilityZone;
					$platform = (string) $item->instancesSet->item->platform;
					$name = (string) $item->instancesSet->item->tagSet->item->value;
					$reason = (string) $item->instancesSet->item->stateReason->message;
					$stopped = (string) $item->instancesSet->item->reason;
					if($instanceState === 'stopped'){
						$stopDate = explode('(',$stopped);
						$stopDate1 = explode(')',$stopDate[1]);
						$timeStopped = explode(' G',$stopDate1[0]);
					$date = explode('T',$instanceTime);
					$date1 = explode('.',$date[1]);					
					}
					if ($platform === 'windows') {	
					} else{
					$platform = 'linux';
					}
					if ($name === '') {
						$name = '--- No Name ---';	
					} 
				echo "<tr><td><a href='instance_info.php?instanceId=".$instanceId."'>" . $name . " </td><td><a href='instance_info.php?instanceId=".$instanceId."'>" . $instanceId . "</td><td><a href='instance_info.php?instanceId=".$instanceId."'>" . $imageId . "</td><td><a href='instance_info.php?instanceId=".$instanceId."'>" . $instanceState . "</td> <td><a href='instance_info.php?instanceId=".$instanceId."'>" . $instanceType . "</td> <td><a href='instance_info.php?instanceId=".$instanceId."'>" . $date[0]."&nbsp" .$date1[0]. " </td> <td><a href='instance_info.php?instanceId=".$instanceId."'> " . $timeStopped[0] . " </td> <td><a href='instance_info.php?instanceId=".$instanceId."'> " . $instanceLoc . "</td> <td><a href='instance_info.php?instanceId=".$instanceId."'>" . $platform . "</a></td></tr>";
				
				}	
				echo "</tbody></table>";
				
				?>
        </div><!--/table-->
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
    <script type="text/javascript">$(document).ready(function() {

    $('#instances tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
  </body>
</html>
