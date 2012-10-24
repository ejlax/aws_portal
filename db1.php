<?php
ob_start();
session_start();
include_once('connect.php');
$employeeId = $_SESSION['empId'];
$cCenter = $_SESSION['cCenter'];
//echo $employeeId;
$sql = "SELECT id FROM users WHERE employeeId = '$employeeId'";
$result = mysql_query($sql,$link);
list($empId) = mysql_fetch_array($result);
//echo $sql."<br>";
//echo $empId."<br>";
$sql = "SELECT id FROM costCenters WHERE oracleCode = $cCenter";
$result2 = mysql_query($sql,$link);
list($cCenterId) = mysql_fetch_array($result2);
//echo $sql."<br>";
//echo $cCenter."<br>";
$sql = "INSERT INTO users_costCenters(users_id,users_employeeId,costCenters_id,costCenters_oracleCode) VALUES($empId,$employeeId,$cCenterId,$cCenter)";
mysql_query($sql,$link);
//echo $sql."<br>";
//echo $employeeId."<br>";
//echo $cCenter;
header('location:login.php');
ob_flush();
?>