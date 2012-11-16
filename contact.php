<?php
session_start();
include_once 'verify.php';
include_once 'header.php';
include_once 'connect.php';




?>


  <!--  <div class="hero-unit">
            <h1>AWS Instance List</h1>
            <p>Live list of all instances in AWS</p>
            <p><a class="btn btn-primary btn-large" href="//aws.amazon.com/what-is-aws/">Learn more &raquo;</a></p>
          </div>  -->
		<div class="span10 content">
        <!-- Main hero unit for a primary marketing message or call to action -->
        <!-- Tabs -->
          <h3>Contact Us</h3>
          <div class="span10">
          <div class="tabbable tabs-left">          	
          <div id="nav nav-tab" class="span7 tab-content">
              <div id="contactForm">
              <form method="post" name="contact" action="<?php echo $PHP_SELF;?>">
                   <fieldset>
    <legend>Contact Form:</legend>
    Name: <input type="text" name="name"><br>
    Email: <input type="text" name="email"><br>
    Question/Comment: <br><textarea rows="5" name="message"> </textarea><br>
    <input type="submit" name="submit" value="Submit">
  </fieldset>
                  
              </form>
              </div>
              
              <div id="submittedMsg" style="display:none">
                  Thank you for your comment.                  
              </div>
              
              
         	</div><!--/nav-tab-->
        	</div><!--/tabbable-->


<?php 
include_once 'footer.php';
if (isset($_POST["name"]))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
     $query = "INSERT INTO site_messages (name, email, message) VALUES('". $name . "', '" . $email . "', '". $message ."')";

     /*$link = mysql_connect('localhost','root','');
    
     mysql_select_db("aws", $link);*/
     $result = mysql_query($query, $link);     

     if ($result > 0)
     {
         echo "<script language=javascript>$('#contactForm').hide(); $('#submittedMsg').show();</script>";
     }
     
}
?>