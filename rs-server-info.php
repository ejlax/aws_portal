<?php
//include_once('verify.php');
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
              <li class="active"><a href="view_instances.php">View Instances</a></li>
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
        <div class='row-fluid span10'>
        <div class="span6 pull-left">
         	<div>
         	<h3>Instance Info</h3>
			<?php
			require_once('AWSSDKforPHP/rs-api-creds.php');          
          /*$rs_api = array(
			'version' => '1.0',
			'account_id' => 46971,
			'username' => "",
			'password' => "",
			'cookie_file' => 'tmp/rs_api_cookie.txt',
			//'cookie_file' => tempnam("/tmp", "rs_api"),
		);*/
		
		$rs_api['url'] = "https://my.rightscale.com/api/acct/".$rs_api['account_id'];
		
		$rs_api['login_url'] = $rs_api['url']."/login?api_version=".$rs_api['version'];
		
		$ch = curl_init($rs_api['login_url']);
		
		curl_setopt($ch, CURLOPT_COOKIEJAR, $rs_api['cookie_file']);
		curl_setopt($ch, CURLOPT_USERPWD,$rs_api['username'].':'.$rs_api['password']);
		
		curl_exec($ch);
		curl_close($ch);
		
		$url = $rs_api['url']."/servers?api_version=".$rs_api['version'];
		
		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_COOKIEFILE, $rs_api['cookie_file']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		
		
		$xml = new SimpleXMLElement( curl_exec($ch));
		curl_close($ch);
		
		//print_r($xml);
		$i=0;
		//$servers = $xml->server->children();
		
		//print_r($xml['server']);
		echo "
		Start Server: </p>
			<form method='get' action='rs-api-start.php'>
			<select name='serverid'>";
		foreach($xml->server as $server){
			$i++;
			$nickname = (string) $server->nickname;
			$url = (string) $server->href;
			$depl = (string) $server->deployment-href;
			$servers = explode('servers/', $url);
			$serverid = $servers[1];
			echo "<option value='" .$serverid ."'>" .$nickname ."</option>";
				
		}
		echo "</select></br>
		<select name='type'>
		<option value='stop'>Stop</option>
		<option value='start'>Start</option>
		</select>
		<input type='submit' value='submit' name='submit'>";
		  
		 ?>         
		
         	</div>
        </div>
        <div class="span4 pull-left">
         	<div>
         	<h3>Instance Actions</h3>
         	</div>
        </div>  	
		<!-- <div class="table offset 3" id="instances">  -->
			
		</div>

		</div>
      </div><!--/row-->

      <hr>

      <footer align='center'>
        <p>&copy; Company 2012</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="bootstrap.js"></script>
  </body>
</html>
