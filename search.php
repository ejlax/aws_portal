<?php
include_once('verify.php');
require_once 'AWSSDKforPHP/sdk.class.php';
$ec2 = new AmazonEC2();
include_once('header.php');
?>

        <div class="span10">
          <div class="hero-unit">
            <h1>Instance Search</h1>
            <p>Search all instances in AWS</p>
            <form class='form-search' method='get' action='' id='search'>
            	<input type='text' name='search' placeholder='Search'>
            	<Select name='filter'>
            		<option value=0>All</option>
            		<option value=1>Instance Id</option> 
            		<option value=2>Name</option>  
            		<option value=3>Platform</option>
            		<option value=4>State (running, stopped, etc)</option>
            		<option value=5>Availability Zone</option>            		         		
            	</Select>
            	<!-- save for a later date 
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
				  </div>  -->

            	<button type='submit' class='btn-primary' value='Search'>Search</button>
            	<img id='loading' style='display: none;' src='img/ajax-loader.gif'>
            </form>
            
          </div>
          <h3>Results</h3>
          <div id='instances'>
          			<!--  Where the AJAX return HTML will go -->
          </div>

      </div><!--/row-->

      <hr>


    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript">$(document).ready(function() {

    $('#instances tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
<script>$('#search').bind('submit', function() {
  $('#loading').show()
});
</script>
<script>
	$("#search").submit(function(){
		$("#loading").submit(function(){
    $(this).show();
}).ajaxStop(function(){
   $(this).hide();
});
    // Intercept the form submission
    var formdata = $(this).serialize(); // Serialize all form data

    // Post data to your PHP processing script
    $.get( "searchwork.php", formdata, function( data ) {
        // Act upon the data returned, setting it to #success <div>
        $("#instances").html ( data );
    });

    return false; // Prevent the form from actually submitting
});
</script>
<?php
include_once('footer.php');
