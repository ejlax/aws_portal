<?php
ob_start();
?>
<!DOCTYPE html>

<html>
<head>
<title>Create a nice login form using CSS3 and HTML5</title>
<style>

html, body
{
    height: 100%;
}

body
{
    font: 12px 'Lucida Sans Unicode', 'Trebuchet MS', Arial, Helvetica;    
    margin: 0;
    background-color: #d9dee2;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebeef2), to(#d9dee2));
    background-image: -webkit-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -moz-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -ms-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -o-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: linear-gradient(top, #ebeef2, #d9dee2);    
}

/*--------------------*/

#login
{
    background-color: #cccccc;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#eee));
    background-image: -webkit-linear-gradient(top, #fff, #eee);
    background-image: -moz-linear-gradient(top, #fff, #eee);
    background-image: -ms-linear-gradient(top, #fff, #eee);
    background-image: -o-linear-gradient(top, #fff, #eee);
    background-image: linear-gradient(top, #fff, #eee);  
    /*height: 240px;*/
    width: 400px;
    margin: -150px 0 0 -230px;
    padding: 30px;
    position: relative;
    top: 50%;
    left: 50%;
    z-index: 0;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;  
    -webkit-box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),
          0 1px 1px rgba(0, 0, 0, .2),
          0 3px 0 #fff,
          0 4px 0 rgba(0, 0, 0, .2),
          0 6px 0 #fff,  
          0 7px 0 rgba(0, 0, 0, .2);
    -moz-box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),  
          1px 1px   0 rgba(0,   0,   0,   .1),
          3px 3px   0 rgba(255, 255, 255, 1),
          4px 4px   0 rgba(0,   0,   0,   .1),
          6px 6px   0 rgba(255, 255, 255, 1),  
          7px 7px   0 rgba(0,   0,   0,   .1);
    box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),  
          0 1px 1px rgba(0, 0, 0, .2),
          0 3px 0 #fff,
          0 4px 0 rgba(0, 0, 0, .2),
          0 6px 0 #fff,  
          0 7px 0 rgba(0, 0, 0, .2);
}

#login:before
{
    content: '';
    position: relative;
    z-index: -1;
    border: 1px dashed #ccc;
    top: 5px;
    bottom: 5px;
    left: 5px;
    right: 5px;
    -moz-box-shadow: 0 0 0 1px #fff;
    -webkit-box-shadow: 0 0 0 1px #fff;
    box-shadow: 0 0 0 1px #fff;
}

/*--------------------*/

h1
{
    text-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0px 2px 0 rgba(0, 0, 0, .5);
    text-transform: uppercase;
    text-align: center;
    color: #3366cc;
    margin: 0 0 30px 0;
    letter-spacing: 4px;
    font: normal 26px/1 Verdana, Helvetica;
    position: relative;
}

h1:after, h1:before
{
    background-color: #3366cc;
    content: "";
    height: 1px;
    position: relative;
    top: 15px;
    width: 120px;   
}

h1:after
{ 
    background-image: -webkit-gradient(linear, left top, right top, from(#777), to(#fff));
    background-image: -webkit-linear-gradient(left, #777, #fff);
    background-image: -moz-linear-gradient(left, #777, #fff);
    background-image: -ms-linear-gradient(left, #777, #fff);
    background-image: -o-linear-gradient(left, #777, #fff);
    background-image: linear-gradient(left, #777, #fff);      
    right: 0;
}

h1:before
{
    background-image: -webkit-gradient(linear, right top, left top, from(#777), to(#fff));
    background-image: -webkit-linear-gradient(right, #777, #fff);
    background-image: -moz-linear-gradient(right, #777, #fff);
    background-image: -ms-linear-gradient(right, #777, #fff);
    background-image: -o-linear-gradient(right, #777, #fff);
    background-image: linear-gradient(right, #777, #fff);
    left: 0;
}

/*--------------------*/

fieldset
{
    border: 0;
    padding: 0;
    margin: 0;
}

/*--------------------*/

#inputs input
{
    background: #f1f1f1 url(http://www.red-team-design.com/wp-content/uploads/2011/09/login-sprite.png) no-repeat;
    padding: 15px 15px 15px 30px;
    margin: 0 0 10px 0;
    width: 353px; /* 353 + 2 + 45 = 400 */
    border: 1px solid #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
}

#employeeId
{
    background-position: 5px -2px !important;
    font: normal 18px/1 Verdana, Helvetica;
    	color: #003399;
}

#new_password
{
    background-position: 5px -52px !important;
    font: normal 18px/1 Verdana, Helvetica;
}

#verify_password
{
    background-position: 5px -52px !important;
    font: normal 18px/1 Verdana, Helvetica;
}


#inputs input:focus
{
    background-color: #fff;
    border-color: #3366CC;
    outline: none;
    -moz-box-shadow: 0 0 0 1px #e8c291 inset;
    -webkit-box-shadow: 0 0 0 1px #e8c291 inset;
    box-shadow: 0 0 0 1px #e8c291 inset;
}

/*--------------------*/
#actions
{
    margin: 25px 0 0 0;
}

#submit
{		
    background-color: #BBBBBB;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#BBBBBB), to(#AAAAAA));
    background-image: -webkit-linear-gradient(top, #BBBBBB, #AAAAAA);
    background-image: -moz-linear-gradient(top, #3366CC, #003366);
    background-image: -ms-linear-gradient(top, #3366CC, #003366);
    background-image: -o-linear-gradient(top, #3366CC, #003366);
    background-image: linear-gradient(top, #3366CC, #003366);
    
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    
    text-shadow: 0 1px 0 rgba(255,255,255,0.5);
    
     -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
     -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
     box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;    
    
    border-width: 1px;
    border-style: solid;
    border-color: #CCCCCC;

    float: left;
    height: 35px;
    padding: 0;
    width: 120px;
    cursor: pointer;
    font: bold 15px Arial, Helvetica;
    color: #CCCCCC;
}

#submit:hover,#submit:focus
{		
    background-color: #3366CC;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#3366CC), to(#003366));
    background-image: -webkit-linear-gradient(top, #3366CC, #003366);
    background-image: -moz-linear-gradient(top, #3366CC, #003366);
    background-image: -ms-linear-gradient(top, #3366CC, #003366);
    background-image: -o-linear-gradient(top, #3366CC, #003366);
    background-image: linear-gradient(top, #3366CC, #003366);
}	

#submit:active
{		
    outline: none;
   
     -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
     -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
     box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;		
}

#submit::-moz-focus-inner
{
  border: none;
}

#actions a
{
    color: #AAA;    
    float: right;
    line-height: 35px;
    margin-left: 10px;
}

/*--------------------*/

#back
{
    display: block;
    text-align: center;
    position: relative;
    top: 60px;
    color: #999;
}


</style>
</head>
		<script type="text/javascript" src="/../aws/js/nav.js"></script>

<body>

<form method="post" action="" id="login">
    <h1>Reset Password</h1>
    <fieldset id="inputs">
        <input id="employeeId" name="employeeId" type="text" placeholder="Employee ID" autofocus required>   
        <input id="new_password" name="new_password" type="password" placeholder="New Password" required>
        <input id="verify_password" name="verify_password" type="password" placeholder="Verify Password" required>
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" value="Reset">
        <a href="/../aws/reset_password.php">Forgot your password?</a><a href="login.php">Already Have Account?</a>
    </fieldset>

</form>

</body>
</html>
<?php
session_start();
include_once ('connect.php');
include_once ('../config/salt.php');
if (isset($_POST['new_password']) and isset($_POST['verify_password']) and isset($_POST['employeeId'])) {
	$empId = ($_POST['employeeId']);
	$new_pwd = sha1($_POST['new_password'].$pepper);
	$verify_pwd = sha1($_POST['verify_password'].$pepper);
	if ($new_pwd == $verify_pwd){
		$sql = "SELECT DISTINCT id FROM users WHERE employeeId='$empId'";
		$result = mysql_query($sql,$link);
		//echo $sql."<br>";
		list($id)=mysql_fetch_array($result);
		//echo $id."<br>";
		$sql = "SELECT password FROM users WHERE id=$id";
		//echo $sql;
		$result = mysql_query($sql,$link);
		if (!$result) { // add this check.
    die('Invalid query: ' . mysql_error());
		}
		//echo $user['email'];
		list($old_pwd) = mysql_fetch_array($result);

		$sql = "SELECT email FROM users WHERE id=$id";
		//echo $sql;
		$result = mysql_query($sql,$link);
		if (!$result) { // add this check.
    die('Invalid query: ' . mysql_error());
		}
		//echo $user['email'];
		list($email) = mysql_fetch_array($result);
		$query = "UPDATE users SET password='$new_pwd' WHERE id=$id";
		mysql_query($query,$link);
		echo $query."<p></p>";
		$query = "SELECT password FROM users WHERE id=$id";
		$result = mysql_query($query,$link);
		list($new_pwd) = mysql_fetch_array($result);
		//echo $query."<br>";
		$to = "$email";
		$subject = "Password Reset";
		$body = "Your Password has been successfully reset. Please '<a href=http://localhost:8888/TestSite/login.php>login</a>' again.";
		if (mail($to, $subject, $body)) {
		   echo("<p>Message successfully sent!</p>");
		  } else {
		   echo("<p>Message delivery failed...</p>");
		  }
		if ($new_pwd == $verify_pwd) {
			echo "Your new password has been successfully changed. You may now <a href='login.php'>login</a><p></p>";
			}
	}else{
		echo "<b>Passwords do not match. Please re-enter your new password.<b>";
	}
}
ob_flush();
?>
