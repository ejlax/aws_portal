<?php
	require_once 'AWSSDKforPHP/sdk.class.php';
	$ec2 = new AmazonEC2();
	$ec2->set_hostname('ec2.us-east-1.amazonaws.com');
	
	if ($_GET['filter'] == 0 ) {
		$response = $ec2->describe_instances();
		$i=0;
		foreach($response->body->reservationSet->item as $item){
			$i++;}
		echo "<h5>".$i." Instances matched that query</h5><br>";
		echo "<div class='table'>";
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
				echo "</tbody></table></div>";
	}

	if($_GET['filter'] == 1){
	$response = $ec2->describe_instances(array(
					InstanceId => $_GET['search']		
							));
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

				if ($platform === 'windows') {
					
				} else{
					$platform = 'Linux';
				}
				if ($name === '') {
						$name = '--- No Name ---';	
					}
		
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
		
	}

		if($_GET['filter'] == 3){
			$search = strtolower($_GET['search']);
			if(isset($search)){
				$response = $ec2->describe_instances(array(
				'Filter' => array(
				array('Name' => 'platform', 'Value' => $search))));
				$i=0;
				foreach($response->body->reservationSet->item as $item){
					$i++;
				}
				if($search == 'linux' or $seach == 'Linux'){
					echo "Unable to search by Platform for Linux due to AWS API constraints, please search again.";
					//echo "There were no instances found for the criteria: Filter=Platform and Search Term=".$search;
					exit();
				}elseif($i===0){
					echo "There were no instances found for the criteria: Filter=Platform and Search Term=".$search;
				}
				echo "<h5>".$i." Instances matched that query.</h5><br>";
				echo "<div class='table'>";
				echo "<table id='instances' class='table-condensed table-bordered table-striped table-hover' align='center'>";
				echo "<thead><tr class='info'><th>Instance&nbsp;Name</th><th>InstanceId</th><th>AMI&nbsp;ID</th><th>InstanceState</th><th>InstanceType</th><th>InstanceTime</th><th>Time&nbspStopped</th><th>AZ</th><th>OS</td>";
				echo "<tbody>";
				foreach($response->body->reservationSet->item as $item){
					$count++;
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
				echo "</tbody></table></div>";
	}
	if ($_GET['filter'] == 3 and $search == 'linux') {
		echo "Unable to search by Platform for Linux due to AWS API constraints, please search again.";
	}
	}

	if ($_GET['filter'] == 2) {				
				$response = $ec2->describe_instances(array(
				'Filter' => array(
				array('Name' => 'tag:Name', 'Value' => $_GET['search']),
				)));
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

				if ($platform === 'windows') {
					
				} else{
					$platform = 'Linux';
				}
				if ($name === '') {
						$name = '--- No Name ---';	
					}
		
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
	}
	
	if($_GET['filter'] == 5){
				$search = $_GET['search'];
				$response = $ec2->describe_instances(array(
				'Filter' => array(
				array('Name' => 'availability-zone', 'Value' => $search),
				
				)));
				$i=0;
				foreach($response->body->reservationSet->item as $item){
				$i++;
				}	
				if($i == 0){
					echo "There were no instances found for the criteria: Filter=Availbility Zone and Search Term=".$search;
					exit();
				}
				echo "<h5>".$i." Instances matched that query.</h5><br>";
				echo "<div class='table'>";
				echo "<table id='instances' class='table-condensed table-bordered table-striped table-hover' align='center'>";
				echo "<thead><tr class='info'><th>Instance&nbsp;Name</th><th>InstanceId</th><th>AMI&nbsp;ID</th><th>InstanceState</th><th>InstanceType</th><th>InstanceTime</th><th>Time&nbspStopped</th><th>AZ</th><th>OS</td>";
				echo "<tbody>";
				foreach($response->body->reservationSet->item as $item){
					$count++;
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
				echo "</tbody></table></div>";
	}
	if ($_GET['filter'] == 3 and $search == 'linux') {
		echo "Unable to search by Platform for Linux due to AWS API constraints, please search again.";
	}
	
		if($_GET['filter'] == 4){
				$search = $_GET['search'];
				$response = $ec2->describe_instances(array(
				'Filter' => array(
				array('Name' => 'instance-state-name', 'Value' => $search),
				
				)));
				$i=0;
				foreach($response->body->reservationSet->item as $item){
				$i++;
				}	
				if($i == 0){
					echo "There were no instances found for the criteria: Filter=Availbility Zone and Search Term=".$search;
					exit();
				}
				echo "<h5>".$i." Instances matched that query.</h5><br>";
				echo "<div class='table'>";
				echo "<table id='instances' class='table-condensed table-bordered table-striped table-hover' align='center'>";
				echo "<thead><tr class='info'><th>Instance&nbsp;Name</th><th>InstanceId</th><th>AMI&nbsp;ID</th><th>InstanceState</th><th>InstanceType</th><th>InstanceTime</th><th>Time&nbspStopped</th><th>AZ</th><th>OS</td>";
				echo "<tbody>";
				foreach($response->body->reservationSet->item as $item){
					$count++;
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
				echo "</tbody></table></div>";
	}
	/*if ($_GET['filter'] == 3 and $search == 'linux') {
		echo "Unable to search by Platform for Linux due to AWS API constraints, please search again.";
	}*/
	
?>
