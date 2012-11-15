<?php
include_once('verify.php');
require_once 'AWSSDKforPHP/sdk.class.php';
$ec2 = new AmazonEC2();
include_once('header.php');
?>
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
				$intIP = (string) $item->instancesSet->item->privateIpAddress;
				$extIP = (string) $item->instancesSet->item->ipAddress;
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
			<div class='row-fluid'>
				<div class='span3 pull-left'>
			<p>
			<h5>" . $reason ." on ". $timeStopped[0] . "</h5>
			</p>
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
						<div class='row-fluid'>
				<div class='span3 pull-left'>
			<p>
			<h5>" . $reason ." on ". $timeStopped[0] . "</h5>
			</p>
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
          	<dt>Public IP:</dt>
          	<dd>" . $extIP ."</dd>
          	<dt>Internal IP:</dt>
          	<dd>" . $intIP ."</dd>
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
include_once('footer.php');
?>
