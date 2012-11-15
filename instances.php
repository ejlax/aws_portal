<?php
include_once('verify.php');
require_once 'AWSSDKforPHP/sdk.class.php';
$ec2 = new AmazonEC2();
include_once('header.php');
?>
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
              	<form class="form-condensed" method="post" action="create.php" id='create'>
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
				  <button type="submit" class="btn">Launch Instance</button><img id='loading' style='display: none;' src='img/ajax-loader.gif'>
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
      
      <script>$('#create').bind('submit', function() {
  $('#loading').show()
});
</script>
<script>
	$("#create").submit(function(){
		$("#loading").submit(function(){
    $(this).show();
}).ajaxStop(function(){
   $(this).hide();
});
</script>
<?php
include_once('footer.php');
