<?php
error_reporting(E_ALL ^ E_NOTICE);
ob_start();
session_start();
include_once ('salt.php');
include_once ('connect.php');
//echo $_SESSION['LAST_ACTIVITY']."<br>";
//echo time()."<br>";
//unset($_SESSION['LAST_ACTIVITY']);
if (!isset($_SESSION['LAST_ACTIVITY'])){
	echo "You are not logged in. Redirecting you to the login page.<br>Click&nbsp<a href='login.php'>here</a> if you are not automatically redirected.";
	header("refresh: 5;url=login.php");
	break;
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    // last request was more than 15 minutes ago
    //$_SESSION = array();     // unset $_SESSION variable for the runtime 
    session_destroy();   // destroy session data in storage
    $file=$_SERVER['PHP_SELF'];
	//$_SERVER['PHP_SELF'] would /lecture8/page2.php
	$arr=explode("/",$file);
	$count=count($arr);
	$file=$arr[$count-1];
	header('Location:login.php?file='.$file);
    echo "Your Session has expired. Please Login again.<br> Redirecting...<p></p>Click&nbsp<a href='login.php?file=".$file."'>here</a> if you are not automatically redirected.";
	//sleep(5);//seconds to wait..
	break;
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 900)){
		$auth = $_SESSION['salt'];
		$pwd = $_SESSION['pwd'];
		if(isset($_SESSION['user']) and isset($_SESSION['loginTime']) and isset($_SESSION['hash'])) {
			$user = $_SESSION['user'];
			$time = $_SESSION['loginTime'];
			$hash = $_SESSION['hash'];
			//echo $hash."<br>";
			//echo $auth."<br>";
			$sql = "SELECT firstName,lastName FROM users WHERE email='$user' AND password='$pwd'";
			$result = mysql_query($sql, $link);
			$name = mysql_fetch_array($result);
			//echo $sql."<br>";
			$hashCalculated = sha1($user.$time.$auth);
			//echo $hashCalculated."<br>";
				if ($hash != $hashCalculated) {
				//header('location:login_form.php');
				echo "check the log files, the user was not authenticated!";
				}
	}
}
    $file=$_SERVER['PHP_SELF'];
	//$_SERVER['PHP_SELF'] would /lecture8/page2.php
	$arr=explode("/",$file);
	$count=count($arr);
	$file=$arr[$count-1];

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
              <li><a href="fluid.php">Home</a></li>
              <li><a href="instances.php">Create Instances</a></li>
              <li class="active"><a href="view_instances.php">View Instances</a></li>
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
        <div class='row-fluid span10'>
        <div class="span6 pull-left">
         	<div>
         	<h3>Instance Info</h3>
          	<label><h5>Instance Id:&nbsp;<?php echo $_GET['instanceId'];?></h5></label>
         	</div>
        </div>
        <div class="span4 pull-left">
         	<div>
         	<h3>Instance Actions</h3>
         	</div>
        </div>  	
		<!-- <div class="table offset 3" id="instances">  -->
			
		</div>

          <?php
				require_once 'AWSSDKforPHP/sdk.class.php';
				$ec2 = new AmazonEC2();
				$ec2->set_hostname('ec2.us-east-1.amazonaws.com');
				//echo $_GET['instanceId'];
				$instance_id = $_GET['instanceId'];
				$password = $_GET['winpass'];
				$response = $ec2->describe_instances(array(
					InstanceId => $instance_id
					)
				); 
				//print_r($response);
				/*%******************************************************************************************%*/
				//echo "<table id='instances' class='table-condensed table-bordered table-striped table-hover' align='center'>";
				//echo "<thead><tr class='info'><th>Instance&nbsp;Name</th><th>InstanceId</th><th>AMI&nbsp;ID</th><th>InstanceState</th><th>InstanceType</th><th>InstanceTime</th><th>Time&nbspStopped</th><th>AZ</th><th>OS</td>";
				//echo "<tbody>";
				//$instances = array();	
				$item = $response->body->reservationSet->item;
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
				}
				$date = explode('T',$instanceTime);
				$date1 = explode('.',$date[1]);
				
				//echo "<tr> <td> " . $name . " </td><td> " . $instanceId . " </td> <td>" . $imageId . "</td> <td>" . $instanceState . "</td> <td>" . $instanceType . "</td> <td>" . $date[0]."&nbsp" .$date1[0]. " </td> <td> " . $timeStopped[0] . " </td> <td> " . $instanceLoc . "</td> <td>" . $platform . "</td></tr>";
				
				//echo "</tbody></table>";
				if ($platform === 'windows') {
					
				} else{
					$platform = 'Linux';
				}
				if ($name === '') {
						$name = '--- No Name ---';	
					}
				?>
        <!--  </div><!--/table-->
        <?php
						
        if ($instanceState === "stopped" && $platform === 'Linux') {
          echo "<div class='row-fluid span10'>
          <div class='span6'>
          <dl class='dl-horizontal pull-left'>
          	<dt>Name:</dt>
          	<dd>". $name . "</dd>
          	<dt>AMI Id:</dt>
          	<dd>". $imageId . "</dd>
          	<dt>Date Started:</dt>
          	<dd>". $date[0]."&nbsp" .$date1[0] . "</dd>
          	<dt>Date Stopped:</dt>
          	<dd>". $timeStopped[0] . "</dd>
          	<dt>Availability Zone:</dt>
          	<dd>". $instanceLoc . "</dd>
          	<dt>Platform:</dt>
          	<dd>" . $platform ."</dd>
          	<dt>Instance Size:</dt>
          	<dd>" . $instanceType ."</dd>
          	<p>
			<h5>" . $reason ." on ". $timeStopped[0] . "</h5>
			</p>
          </dl>                    
          </div>
          <div class='span4'>
          	<div>	
        		<form class='form' method='get' action='start.php'>
        		<input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		<input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Start Instance</button>
				</form>
			</div>
          	<div>	
        		<form class='form' method='get' action='reboot.php'>
        		<input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		<input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Reboot Instance</button>
				</form>
			</div>
			 <div>	
        		<form class='form' method='get' action='terminate.php'>
        		  <input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		  <input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Terminate Instance</button>
				</form>
			</div> 
			</div> 
        ";}
        if ($instanceState == "stopped" && $platform == 'windows') {
          echo "<div class='row-fluid span10'>
          <div class='span6'>
          <dl class='dl-horizontal pull-left'>
          	<dt>Name:</dt>
          	<dd>". $name . "</dd>
          	<dt>AMI Id:</dt>
          	<dd>". $imageId . "</dd>
          	<dt>Date Started:</dt>
          	<dd>". $date[0]."&nbsp" .$date1[0] . "</dd>
          	<dt>Date Stopped:</dt>
          	<dd>". $timeStopped[0] . "</dd>
          	<dt>Availability Zone:</dt>
          	<dd>". $instanceLoc . "</dd>
          	<dt>Platform:</dt>
          	<dd>" . $platform ."</dd>
          	<dt>Instance Size:</dt>
          	<dd>" . $instanceType ."</dd>
          	<dt>Password:</dt>
          	<dd>" . $password ."</dd>
          	<p>
			<h5>" . $reason ." on ". $timeStopped[0] . "</h5>
			</p>
          </dl>                    
          </div>
          <div class='span4'>
          	<div>	
        		<form class='form' method='get' action='start.php'>
        		<input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		<input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Start Instance</button>
				</form>
			</div>
          	<div>	
        		<form class='form' method='get' action='reboot.php'>
        		<input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		<input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Reboot Instance</button>
				</form>
			</div>
			 <div>	
        		<form class='form' method='get' action='terminate.php'>
        		  <input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		  <input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Terminate Instance</button>
				</form>
			</div>
			<div>	
        		<form class='form' method='get' action='windows_pass.php'>
        		  <input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		  <input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Get Admin Password</button>
				</form>
			</div> 
			</div> 
        ";}
        if ($instanceState == "running" && $platform == 'windows') {
          echo "<div class='row-fluid span10'>
          <div class='span6'>
          <dl class='dl-horizontal pull-left'>
          	<dt>Name:</dt>
          	<dd>". $name . "</dd>
          	<dt>AMI Id:</dt>
          	<dd>". $imageId . "</dd>
          	<dt>Date Started:</dt>
          	<dd>". $date[0]."&nbsp" .$date1[0] . "</dd>
          	<dt>Availability Zone:</dt>
          	<dd>". $instanceLoc . "</dd>
          	<dt>Platform:</dt>
          	<dd>" . $platform ."</dd>
          	<dt>Instance Size:</dt>
          	<dd>" . $instanceType ."</dd>
          	<dt>Password:</dt>
          	<dd>" . $password ."</dd>
          </dl>                    
          </div>
          <div class='span4'>
          	<div>	
        		<form class='form' method='get' action='stop.php'>
        		<input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		<input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Stop Instance</button>
				</form>
			</div>
          	<div>	
        		<form class='form' method='get' action='reboot.php'>
        		<input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		<input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Reboot Instance</button>
				</form>
			</div>
			 <div>	
        		<form class='form' method='get' action='terminate.php'>
        		  <input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		  <input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Terminate Instance</button>
				</form>
			</div>
			<div>	
        		<form class='form' method='get' action='windows_pass.php'>
        		  <input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		  <input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Get Admin Password</button>
				</form>
			</div> 
			</div> 
        ";}
          if ($instanceState == "running" && $platform == 'Linux') {
          echo "<div class='row-fluid span10'>
          <div class='span6'>
          <dl class='dl-horizontal pull-left'>
          	<dt>Name:</dt>
          	<dd>". $name . "</dd>
          	<dt>AMI Id:</dt>
          	<dd>". $imageId . "</dd>
          	<dt>Date Started:</dt>
          	<dd>". $date[0]."&nbsp" .$date1[0] . "</dd>
          	<dt>Availability Zone:</dt>
          	<dd>". $instanceLoc . "</dd>
          	<dt>Platform:</dt>
          	<dd>" . $platform ."</dd>
          	<dt>Instance Size:</dt>
          	<dd>" . $instanceType ."</dd>
          </dl>                    
          </div>
          <div class='span4'>
          	<div>	
        		<form class='form' method='get' action='stop.php'>
        		<input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		<input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Stop Instance</button>
				</form>
			</div>
          	<div>	
        		<form class='form' method='get' action='reboot.php'>
        		<input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		<input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Reboot Instance</button>
				</form>
			</div>			
			 <div>	
        		<form class='form' method='get' action='terminate.php'>
        		  <input type='hidden' name='instanceId' value='" . $instanceId . "'/>
        		  <input type='hidden' name='file' value='" . $file ."'/>
				  <button type='submit' class='btn'>Terminate Instance</button>
				</form>
			</div> 
			</div>
			  <div class='row-fluid'>
				<div class='span4'>
				<h5>".$_GET['status_start'].$_GET['status_stop'].$_GET['status_terminate']."</h5>
				</div>
			</div>
        ";}
                if ($instanceState === "terminated") {
          echo "<div class='span6'>
          <h5><b class='icon-remove-sign'></b>Instance ". $instance_id ." was terminated on " . $date[0]."&nbsp" .$date1[0] . "</h5>	
          <p>
          <h5>". $reason ."</h5>
			</div>  
        ";
        			header('Refresh: 10');
        }
				//-----start temporary states------//
                        if ($instanceState === "shutting-down") {
          echo "<div class='span6'>
          <h5>Instance ". $instance_id ."was shut down on " . $date[0]."&nbsp" .$date1[0] . "</h5>	
			</div>  
        ";
        			header('Refresh: 10');
        }
          if ($instanceState === "stopping") {
          echo "<div class='span6'>
          <h5>Instance ". $instance_id ." was shut down on " . $date[0]."&nbsp" .$date1[0] . "</h5>	
			</div> 
			</div>";
			header('Refresh: 10');
        }
                  if ($instanceState === "pending") {
          echo "<div class='span6'>
          <h5>Instance ". $instance_id ." is starting...</h5>	
			</div>"; 
			header('Refresh: 10'); 
        }
        ?>

		</div>
      </div><!--/row-->

      <hr>

      <footer class='offset1'>
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
