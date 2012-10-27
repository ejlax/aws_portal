<?php
session_start();
include_once('connect.php');
include_once('config/salt.php');
if(isset($_POST['firstName']) and isset($_POST['lastName']) and isset ($_POST['email1']) and isset ($_POST['email2'])and isset($_POST['employeeId']) and isset($_POST['password']) and isset($_POST['costCenter'])){
	if ($_POST['email1'] == $_POST['email2']) {
		$fname=$_POST['firstName'];
		$lname=$_POST['lastName'];
		$email=$_POST['email1'];
		$employeeId=$_POST['employeeId'];
		$cCenter=$_POST['costCenter'];
		$pwd=sha1($_POST['password'].$pepper);
		$_SESSION['email'] = $email;
		$query="SELECT COUNT(id) FROM users where employeeId = '$employeeId'";
		//echo $query."<br>";
		$result=mysql_query($query,$link);
		list($count)=mysql_fetch_array($result);
		//echo $count."<br>";
		if ($count>0){
			echo "That EmployeeId or Email already has an account. Did you "."<a href='reset_password.php'>forget</a>"." your password?";
		}else{
			$query="SELECT COUNT(id) FROM users where email = '$email'";
			//echo $query."<br>";
			$result=mysql_query($query,$link);
			list($count)=mysql_fetch_array($result);
			//echo $count."<br>";
			if ($count>0){
			echo "That EmployeeId or Email already has an account. Did you "."<a href='reset_password.php'>forget</a>"." your password?";
			}else{
				$_SESSION['empId'] = $employeeId;
				$_SESSION['cCenter'] = $cCenter;
				$sql="INSERT INTO users(firstName,lastName,email,employeeId,password,salt) VALUES('$fname','$lname','$email','$employeeId','$pwd','$salt')";
				mysql_query($sql,$link);
				header('location:db1.php');//goto new location
			}
		}
	}else{
	echo "ERROR";
}
}
ob_flush();
//$time = getdate();
//echo "<br>".$time[weekday].",&nbsp".$time[month]."&nbsp".$time[mday].",&nbsp".$time[year]."<br>";
?>
