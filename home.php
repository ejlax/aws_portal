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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pearson AWS Portal</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
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

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>
  <body>
    <div class="topbar">
      <div class="topbar-inner" data-behavior="BS.Dropdown">
        <div class="container-fluid">
          <a class="brand" href="#">Pearson AWS Portal</a>
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
            <li><a href="instances.php">Create Instances</a></li>
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
        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit">
          <h1>Pearson AWS Portal</h1>
          <p>In this portal you will be able to create new AWS instances for QA and Development purposes with the help of the AWS APIs. Your cost center will be billed according to the purchases.</p>
          <p><a class="btn btn-large" href="#" data-reveal-id="myModal" data-animation="fadeAndPop" data-dismissmodalclass="close-reveal-modal">Click for Video</a>
</p>
          	<div id="myModal" class="reveal-modal">
     		<h2>AWS Intro Video</h2>
          		<p><iframe width="420" height="315" src="http://www.youtube.com/embed/CaJCmoGIW24" frameborder="10" allowfullscreen></iframe></p>
     			<a class="close-reveal-modal">&#215;</a>
          	</div>
        </div>
        <!-- Tabs -->
                  <h3>Service Updates</h3>
          <ul data-bs-tabs-options="{}" class="tabs" data-behavior="BS.Tabs">
            <li class="active"><a href="#aws_ec2">AWS Health</a></li>
            <li><a >RightScale</a></li>
            <li><a>Monitoring</a></li>
          </ul>
          <div id="my-tab-content" class="tab-content">
            <div style="display: block; overflow: visible;" class="active" id="aws_ec2">
              <p>
              	<script language="JavaScript" src="http://itde.vccs.edu/rss2js/feed2js.php?src=http%3A%2F%2Fstatus.aws.amazon.com%2Frss%2Fec2-us-east-1.rss&chan=n&num=5&desc=1&date=y&targ=y" type="text/javascript"></script>
				<noscript>
				<a href="http://itde.vccs.edu/rss2js/feed2js.php?src=http%3A%2F%2Fstatus.aws.amazon.com%2Frss%2Fec2-us-east-1.rss&chan=n&num=5&desc=1&date=y&targ=y&html=y">View RSS feed</a>
				</noscript>
			  </p>
            </div>
            <div id="rightscale"><p>
				<script type='text/javascript' charset='utf-8' src='http://scripts.hashemian.com/jss/feed.js?print=yes&numlinks=10&summarylen=50&seedate=yes&popwin=no&url=http:%2F%2Fmy.rightscale.com%2Facct%2F19654%2Fuser_notifications%2Ffeed.atom%3Ffeed_token%3Dfada3a148e2f4effb8e2868a134448e13e466964'>
				</script>
            <p></div>
            <div id="settings">
              <p><a href="#"><img src="https://my.rightscale.com/sketchy1-57/hosts/01-2320B2G/plugins/load/views/load.png?title=prd-mdb-01&period=day&clip=&size=small&deployment_title=&tok=pV4BcejSDhqFWmE0FHDs1AA&tz=America%2FDenver&t=1350079184736"></a></p>
            </div>
          </div>
        <footer>
          <p>&copy; Pearson 2012</p>
        </footer>
      </div>
    </div>
      <script>
    var behavior = new Behavior().apply(document.body);
    var delegator = new Delegator({
      getBehavior: function(){ return behavior; }
    }).attach(document.body);
  </script>
  </body>
</html>