<?php
ob_start();
/**
* The logout file
* destroys the session
* expires the cookie
* redirects to login.php
*/
session_start();
//$_SESSION = array();
unset($_SESSION['salt']);
unset($_SESSION['pwd']);
unset($_SESSION['user']);
unset($_SESSION['loginTime']);
unset($_SESSION['hash']);
unset($_SESSION['LAST_ACTIVITY']);
session_destroy();
header("location:index.php");
?>