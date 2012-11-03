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
                        <ul class="breadcrumb hidden-desktop">
			  <li><a href="fluid.php">Home</a> <span class="divider">/</span></li>
			  <li><a href="instances.php">Instances</a> <span class="divider">/</span></li>
			  <li class="active">Search</li>
			</ul>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav hidden-phone">
            <ul class="nav nav-list">
              <li class="nav-header">Instances</li>
              <li class="active"><a href="instances.php">Create Instances</a></li>
              <li><a href="search.php">Search Instances</a></li>
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
          <!--  <div class="hero-unit">
            <h1>AWS Instance List</h1>
            <p>Live list of all instances in AWS</p>
            <p><a class="btn btn-primary btn-large" href="//aws.amazon.com/what-is-aws/">Learn more &raquo;</a></p>
          </div>  -->
		<div class="span10 content">
        <!-- Main hero unit for a primary marketing message or call to action -->
        <!-- Tabs -->
          <h3>Create Instance</h3>
          <div class="span10">
          <div class="tabbable tabs-left">
          	<ul class="span3 nav nav-tabs">
            <li><a href="#tab1" data-toggle="tab">Instance Information</a></li>
            <li><a href="#tab2" data-toggle="tab">Add Tags</a></li>
            <li><a href="#tab3" data-toggle="tab">Create and Attach Volumes</a></li>
          </ul>	
          <div id="nav nav-tab" class="span7 tab-content">
            <div style="overflow: visible;" class="tab-pane" id="tab1">
              	<form class="form-condensed" method="post" action="create.php">
				  <div class="control-group">
				    <label class="control-label" for="imageId"><h5>Platform</h5></label>
				    <div class="controls">
				      <select name="imageId">
				      	<option value="ami-3d4ff254">Linux</option>
				      	<option value="ami-6cb90605">Windows</option>
				      </select>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="instanceRegion"><h5>Region</h5></label>
				    <div class="controls">
				      <select name="region">
				      	<option value="US_E1">US-East</option>
				      	<option value="US_W1">US-West</option>
				      </select>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="instanceSize"><h5>Instance Size</h5></label>
				    <div class="controls">
				      <select name="instanceType">
				      	<option value="t1.micro">t1.micro</option>
				      	<option value="m1.small">m1.small</option>
				      	<option value="m1.medium">m1.medium</option>
				      	<option value="c1.medium">c1.medium</option>				      	
				      	<option value="m1.large">m1.large</option>
				      	<option value="m1.xlarge">m1.xlarge</option>
				      </select>
				    </div>
				  </div>
				 <div class="control-group">
				    <label class="control-label" for="keyPair"><h5>Key Pair</h5></label>
				    <div class="controls">
				      <select name="keyPair">
						<?php
						$response  = $ec2->describe_key_pairs();
						//print_r($response);
							foreach ($response->body->keySet->item as $item) {
								$keyName = (String) $item->keyName;
								echo "<option value=". $keyName . ">" . $keyName . "</option>";							
							}						
						?>
				      </select>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="securityGroup"><h5>Securty Group</h5></label>
				    <div class="controls">
				      <select name="securityGroupName">
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
				  <button type="submit" class="btn">Launch Instance</button>
				</form>
           	</div>
           	<div style="overflow: visible;" class="tab-pane" id="tab2">
				<form class="form-condensed" method="post" action="create_tag.php">
				 <div class="control-group">
				    <label class="control-label" for="keyPair"><h5>Resource ID</h5></label>
				    <div class="controls">
				      <select name="resource_id">
						<?php
						$response = $ec2->describe_instances();
						//print_r($response);
							foreach($response->body->reservationSet->item as $item){
							$instanceId = (string) $item->instancesSet->item->instanceId;
							echo "<option value=" .$instanceId .">" . $instanceId . "</option>"; 
							}						
						?>
				      </select>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="securityGroup"><h5>Key Name Value Pair</h5></label>
				    <div class="controls">
				    	<label class='control-label' for='keyName'>Key Name</label>
				      <input type='text' name='keyName'>
				    	<label class='control-label' for='keyName'>Key Value</label>				      
				      <input type='text' name='keyValue'>
				    </div>
				  </div>
				  <button type="submit" class="btn">Add Tag</button>
				</form>
           	</div>
           	<div style="overflow: visible;" class="tab-pane" id="tab3">
				<form class="form-condensed" method="post" action="create_vol.php">
				 <div class="control-group">
				    <label class="control-label" for="keyPair"><h5>Instance ID</h5></label>
				    <p>This is the instance to which you will add the volume.</p>
				    <div class="controls">
				      <select name="resource_id">
						<?php
						$response = $ec2->describe_instances();
						//print_r($response);
							foreach($response->body->reservationSet->item as $item){
							$instanceId = (string) $item->instancesSet->item->instanceId;
							$name = (string) $item->instancesSet->item->tagSet->item->value;
							echo "<option value=" .$instanceId .">" . $name ."-" . $instanceId . "</option>"; 
							}						
						?>
				      </select>
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="securityGroup"><h5>Volume Info</h5></label>
				    <div class="controls">
				    <label class='control-label' for='keyName'><h5>Volume Size (in GB)</h5></label>
				      <input type='text' name='size'>	
				    	<label class='control-label' for='keyName'><h5>Tag Name</h5></label>
				    	<p>Tag name of 'name' will give the instance a reference name</p>
				      <input type='text' name='key'>
				    	<label class='control-label' for='keyName'>Tag Value</label>
				    	<p>The value of the tag you want to create</p>			      
				      <input type='text' name='value'>
				    </div>
				  </div>
				  <button type="submit" class="btn">Add Tag</button>
				</form>
           	</div>
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
    <script src="bootstrap.js"></script>
  </body>
</html>
