<?php
session_start();
ob_start();
include_once ('connect.php');
include_once ('config/salt.php');
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
		$body = "Your Password has been successfully reset. Please '<a href=http://98.202.16.56/aws_portal/index.php>'login'</a>' again.";
		if (mail($to, $subject, $body)) {
		   //echo("<p>Message successfully sent!</p>");
		   //$message = 'Email Successfully Changed';
		   
		  } else {
		   echo("<p>Message delivery failed...</p>");
		  }
		if ($new_pwd == $verify_pwd) {
			echo "Your new password has been successfully changed. You may now <a href='login.php'>login</a><p></p>";
			header('Refresh: 5;url=index.php');
			}
	}else{
		//echo "<b>Passwords do not match. Please re-enter your new password.<b>";
	} 
}
ob_flush();
?>