<?php
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<!-- <link href="dropdown.css" rel="stylesheet" type="text/css">  -->


<link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
<link type="text/css" rel="stylesheet" href="css/dropdown.css" charset="utf-8" /> 
<!--[if lt IE 8]>
  <link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection">
<![endif]-->
<html>
<head>
<title>Pearson AWS Instance Portal</title>
<style>

html, body
{
    height: 100%;
}

body
{
    font: 12px 'Lucida Sans Unicode', 'Trebuchet MS', Arial, Helvetica;    
    height: 100%;
    margin: 0;
    background-repeat; no-repeat;
    background-attachment: fixed;
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
    margin: -300px 0 0 -230px;
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
    background: #f1f1f1 /*url(http://www.red-team-design.com/wp-content/uploads/2011/09/login-sprite.png)*/ no-repeat;
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
    font: normal 18px/1 Verdana, Helvetica;
    color: #003399;
}

#employeeId
{
    background-position: 5px -2px !important;
    font: normal 18px/1 Verdana, Helvetica;
    	color: #003399;
}

#email1
{
    background-position: 5px -2px !important;
    font: normal 18px/1 Verdana, Helvetica;
    	color: #003399;
}

#email2
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
#select
{
    background: #f1f1f1 /*url(http://www.red-team-design.com/wp-content/uploads/2011/09/login-sprite.png)*/ no-repeat;
    padding: 15px 15px 15px 15px;
    margin: 0 0 0 0;
    width: 368px; /* 353 + 2 + 45 = 400*/
    border: 1px solid #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    font: normal 24px/1 Verdana, Helvetica;
    color: #AAA;
    height:40px;		
}


</style>
</head>

<body>

<form method="post" action="" id="login">
    <h1>Register</h1>
    <fieldset id="inputs">
    	<input id="firstName" name="firstName" type="text" placeholder="First Name" autofocus required>
        <input id="lastName" name="lastName" type="text" placeholder="Last Name" required>
        <input id="email1" name="email1" type="email" placeholder="Email" required>
        <input id="email2" name="email2" type="email" placeholder="Verify Email" required>
        <input id="employeeId" name="employeeId" type="text" placeholder="Employee ID" required>   
        <input id="password" name="password" type="password" placeholder="Password" required>
    </fieldset>
    <fieldset id="select">
		<select class="select" name=costCenter id=costCenter> 
			<option class="option" value="">---Cost Center---</option>
			<option class="option" value="69333">Implementation Services</option>
			<option class="option" value="69101">Cloud Operations</option>
			<option class="option" value="69501">SIS Operations</option>
			<option class="option" value="69555">Quality Assurance</option>
			<option class="option" value="69599">Development</option>
		</select>
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" value="Register">
        <a href="reset_password.php">Forgot your password?</a><a href="login.php">Already Have Account?</a>
    </fieldset>

</form>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="dropdown.js"></script>
<script type="text/javascript" src="js/nav.js"></script>
</body>
</html>
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
