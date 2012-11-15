<?php
include_once ('verify.php');
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
<?php
include_once('footer.php');
?>
