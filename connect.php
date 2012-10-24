<?php
$link=mysql_connect('localhost:8889','root','root');
if(!$link){
	die('database server connection failed');
}
$check=mysql_select_db('aws',$link);
if(!$check){
	die('database couldnt be reached');
}
?>