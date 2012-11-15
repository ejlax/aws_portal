<?php
ob_start();
//print_r($_POST);
error_reporting(E_ALL ^ E_NOTICE);
include_once ('connect.php');
include_once ('config/salt.php');
//print_r($_POST);
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    // last request was more than 30 minutes ago clear session info
    session_unset();     // unset $_SESSION variable for the runtime 
    session_destroy();   // destroy session data in storage
}
if (!isset($_SESSION['LAST_ACTIVITY'])) {
session_start();
//var_dump($_POST);
$_SESSION['LAST_ACTIVITY'] = time(); 
$time = time();
$_SESSION['loginTime'] = $time;
	if (isset($_POST['email']) and isset($_POST['password'])) {
		$user = $_POST['email'];
		$pwd = sha1($_POST['password'].$pepper);
		$sql1 = "SELECT salt FROM users WHERE email='$user' AND password='$pwd'";
		$sql2 = "SELECT email, password FROM users WHERE email='$user'";
		$result= mysql_query($sql2,$link);
		$email = mysql_fetch_array($result);
		//echo $email[0];
		//exit(); 
		if($email[0] == $user){
			//echo "we have a user match!";
			$sql = "SELECT COUNT(id) FROM users WHERE email='$user' AND password='$pwd'"; 
			$result = mysql_query($sql, $link);
			list($count) = mysql_fetch_array($result);
			//echo $count;
			if ($count > 0) {
				$result = mysql_query($sql1, $link);
				list($salt1) = mysql_fetch_array($result);
				echo $salt1;
				$_SESSION['salt'] = $salt1;
				$_SESSION['pwd'] = $pwd;
				$_SESSION['user'] = $user;
				$hash = sha1($user.$time.$salt1);
				$_SESSION['hash'] = $hash;
				//echo "all session variables set";
				//exit();
				if (isset($_POST['file'])) {
					$file = $_POST['file'];
					//echo $file;
					header('location:auth_user.php?file='.$file);
					}else{
						header('location:auth_user.php');
					}
				}else{
				$message = "1";
				$_SESSION['message'] = $message;
				header('location:login.php');
				}
			}else{
			$message = "1";
			$_SESSION['message'] = $message;
			header('location:login.php');
		}
	}
}
ob_flush();
?>
