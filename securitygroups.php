<?php
error_reporting(E_ALL ^ E_NOTICE);
ob_start();
session_start();
include_once ('salt.php');
include_once ('connect.php');
require_once 'AWSSDKforPHP/sdk.class.php';
$ec2 = new AmazonEC2();
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
$message = $_GET['message'];
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
          <div id="nav nav-tab" class="span7 tab-content">
            <div style="overflow: visible;" class="tab-pane" id="tab1">
              	<form class="form-condensed" method="post" action="create_sg.php">
				  <div class="control-group">
				    <label class="control-label" for="imageId"><h5>Security Group Name</h5></label>
				    <div class="controls">
						<input type='text' name='group_name' required>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="imageId"><h5>Security Group Description</h5></label>
				    <div class="controls">
						<input type='text' name='group_description' required>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="instanceRegion"><h5>Protocol</h5></label>
				    <div class="controls">
				      <select name="IpProtocol">
				      	<option value="tcp">TCP</option>
				      	<option value="udp">UDP</option>
				      </select>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="ip_range"><h5>IP Range (in CIDR)</h5></label>
				    <div class="controls">
						<input type='text' name='ip_range' required>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="fromPort"><h5>From Port</h5></label>
				    <div class="controls">
						<input type='text' name='fromPort' required>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="toPort"><h5>To Port</h5></label>
				    <div class="controls">
						<input type='text' name='toPort' required>
				    </div>
				  </div>
				  <button type="submit" class="btn">Create Security Group</button>
				</form>
           	</div>
           	<div style="overflow: visible;" class="tab-pane" id="tab2">
			<form class="form-condensed" method="post" action="alter-sg.php">
				<div class="control-group">
				    <label class="control-label" for="securityGroup"><h5>Securty Group</h5></label>
				    <div class="controls">
				      <select name="group-id">
						<?php
						$response  = $ec2->describe_security_groups();
						foreach ($response->body->securityGroupInfo->item as $item) {
							$sgName = (String) $item->groupName;
							$sgID = (string) $item->groupId;
							echo "<option value=". $sgID . ">" . $sgName . "</option>";
						}						
						?>
				      </select>
				    </div>
				  </div>				
				<div class="control-group">
				    <label class="control-label" for="instanceRegion"><h5>Protocol</h5></label>
				    <div class="controls">
				      <select name="IpProtocol">
				      	<option value="tcp">TCP</option>
				      	<option value="udp">UDP</option>
				      </select>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="ip_range"><h5>IP Range (in CIDR)</h5></label>
				    <div class="controls">
						<input type='text' name='ip_range' required>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="fromPort"><h5>From Port</h5></label>
				    <div class="controls">
						<input type='text' name='fromPort' required>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="toPort"><h5>To Port</h5></label>
				    <div class="controls">
						<input type='text' name='toPort' required>
				    </div>
				  </div>
				  <button type="submit" class="btn">Update Security Group</button>
				</form>
         	</div><!--/nav-tab-->
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
