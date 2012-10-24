<?php
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
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
