<?php
ob_start();
session_start();
include_once ('config/salt.php');
include_once ('connect.php');
//echo $_SESSION['LAST_ACTIVITY']."<br>";
//echo time()."<br>";
//unset($_SESSION['LAST_ACTIVITY']);
if (!isset($_SESSION['LAST_ACTIVITY'])){
	echo "You are not logged in. Please <a href='login.php'>login</a>";
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    // last request was more than 15 minutes ago
    $_SESSION = array();     // unset $_SESSION variable for the runtime 
    session_destroy();   // destroy session data in storage
    echo "Your Session has expired. Please Login again.<br>";
    echo "<a href='login.php'>Login</a>";
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 900)){
		$auth = $_SESSION['salt'];
		$pwd = $_SESSION['pwd'];
		if(isset($_SESSION['user']) and isset($_SESSION['loginTime']) and isset($_SESSION['hash'])) {
			$user = $_SESSION['user'];
			$time = $_SESSION['loginTime'];
			$hash = $_SESSION['hash'];
			//echo $hash."<br>";
			//echo $auth."<br>";
			$sql = "SELECT firstName,lastName FROM users WHERE email='$user' AND password='$pwd'";
			$result = mysql_query($sql, $link);
			$name = mysql_fetch_array($result);
			//echo $sql."<br>";
			$hashCalculated = sha1($user.$time.$auth);
			//echo $hashCalculated."<br>";
				if ($hash != $hashCalculated) {
				//header('location:login_form.php');
				echo "check the log files, the user was not authenticated!";
				}
		else{
		//echo "Welcome " . $name[0]."&nbsp".$name[1]. "!<br>";
		//echo "<a href='logout.php'>Log Out</a>";
		header('location:fluid.php');
		}
	}
}
ob_flush();
?>


