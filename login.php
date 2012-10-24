<?php
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>

<html>
<head>

<title>Pearson AWS Login</title>
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
    height: 240px;
    width: 400px;
    margin: -150px 0 0 -230px;
    padding: 30px;
    position: absolute;
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
    left: 0px;
    right: 0px;
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
    position: absolute;
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

#email
{
    background-position: 5px -2px !important;
    font: normal 18px/1 Verdana, Helvetica;
    	color: #003399;
}

#password
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

<body>
<div id="login">
	<form method="post" id="login">
    	<h1>Log In</h1>
    	<fieldset id="inputs">
        	<input id="email" name="email"type="text" placeholder="Username" autofocus required>   
        	<input id="password" name="password" type="password" placeholder="Password" required>

    	</fieldset>
    	<fieldset id="actions">
        	<input type="submit" id="submit" value="Log in">
        <a href="reset_password.php">Forgot your password?</a><a href="form.php">Register</a>
    	</fieldset>
	</form>
</div>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/nav.js"></script>
		<script type="text/javascript" src="js/button-disable.js"></script>
</body>
</html>
<?php
include_once ('connect.php');
include_once ('salt.php');
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    // last request was more than 30 minutes ago clear session info
    session_unset();     // unset $_SESSION variable for the runtime 
    session_destroy();   // destroy session data in storage
}
if (!isset($_SESSION['LAST_ACTIVITY'])) {
session_start();
	if (isset($_POST['email']) and isset($_POST['password'])) {
		$user = $_POST['email'];
		$pwd = sha1($_POST['password'].$pepper);
		$sql = "SELECT COUNT(id) FROM users WHERE email='$user' AND password='$pwd'";
		$sql1 = "SELECT salt FROM users WHERE email='$user' AND password='$pwd'";
		$sql2 = "SELECT email,password FROM users WHERE email='$user'";
		$result= mysql_query($sql2,$link);
		$email = mysql_fetch_array($result); 
		if($email[0] == $user){ 
			$result = mysql_query($sql, $link);
			$result2 = mysql_query($sql1, $link);
			list($salt1) = mysql_fetch_array($result2);
			list($count) = mysql_fetch_array($result);
			if ($count > 0) {
				$_SESSION['salt'] = $salt1;
				$_SESSION['pwd'] = $pwd;
				$_SESSION['user'] = $user;
				$_SESSION['LAST_ACTIVITY'] = time(); 
				$time = time();
				$_SESSION['loginTime'] = $time;
				$hash = sha1($user.$time.$salt1);
				$_SESSION['hash'] = $hash;
				//header('location:fluid.php');
				if (isset($_GET['file'])) {
					$file = $_GET['file'];
					header('location:'.$file);
					}else{
						header('location:fluid.php');
					}
				}				header('location:fluid.php');
			echo "Bad Username or Password. <a href='reset_password.php'>Reset Password?</a><br>";
			}else{
		echo "Bad Username or Password. <a href='reset_password.php'>Reset Password?</a><br>";
		}
	}
}
ob_flush();
?>
