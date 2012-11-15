<?php
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$file = $_GET['file'];
if($_SESSION['message'] == 1 ){
$error = 'Bad Username or Password. Please sign in again.';
	}elseif($_GET['message'] == 2){
	$error = 'Your session has timed out. Please Login again.';
	}elseif($_GET['message'] == 4){
	$error = 'That EmployeeId already has an account.';
	}elseif(!isset($_GET['message'])){
		$error = 'Something went wrong. Please sign in again.';
	}
?> <!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <title>Pearson AWS Portal</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <!-- Le styles -->
    <link href='css/bootstrap.css' rel='stylesheet'>
    <style type='text/css'>
      body {
        padding-top: 40px;
        padding-bottom: 10px;
      }
    </style>
    <link href='css/bootstrap-responsive.css' rel='stylesheet'>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel='shortcut icon' href='ico/favicon.ico'>
    <link rel='apple-touch-icon-precomposed' sizes='144x144' href='ico/apple-touch-icon-144-precomposed.png'>
    <link rel='apple-touch-icon-precomposed' sizes='114x114' href='ico/apple-touch-icon-114-precomposed.png'>
    <link rel='apple-touch-icon-precomposed' sizes='72x72' href='ico/apple-touch-icon-72-precomposed.png'>
    <link rel='apple-touch-icon-precomposed' href='ico/apple-touch-icon-57-precomposed.png'>
  </head>

  <body>

    <div class='navbar navbar-fixed-top'>
      <div class='navbar-inner'>
        <div class='container-fluid'>
          <a class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </a>
          <a class='brand' href='#'>AWS Portal</a>
          <div class='nav-collapse collapse'>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class='alert alert-error'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <h4 align='center'>Uh Oh! <?php echo $error;?></h4>
		</div>
	<div class='container'>
          <div class='hero-unit' align='center'>
            <h1>AWS Portal</h1>
            <p>Create new AWS instances, volumes for QA and Development purposes with the help of the AWS APIs, all in real-time.</p>
            <p><a class='btn btn-primary btn-large' href='//aws.amazon.com/what-is-aws/'>Learn more &raquo;</a></p>
          </div>

      <div class='row-fluid'>
          <div class='accordion' id='accordion2'>
			  <div class='accordion-group'>
			    <div class='accordion-heading'>
			      <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapseOne'>
			        Login
			      </a>
			    </div>
			    <div id='collapseOne' class='accordion-body collapse in'>
			      <div class='accordion-inner'>
			        <form id='login' class='form-horizontal' method='post' action='login-beta.php'>
										<fieldset>
  											<label class='UsernameLabel'>Email</label>
												<input type='email' id='Form_Email' name='email' class='InputBox' required>
												<label class='PasswordLabel'>Password</label>
												<input type='password' id='Form_Password' name='password' class='InputBox Password' required>
												<input type='hidden' name='file' value='<?php if(isset($file)){echo $file;}?>'>
											<input type='submit' name='submit' value='Sign In' class='btn btn-primary'>
										</fieldset>
									</form>
			      </div>
			    </div>
			  </div>
			  <div class='accordion-group'>
			    <div class='accordion-heading'>
			      <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapseTwo'>
			        Forgot Password?
			      </a>
			    </div>
			    <div id='collapseTwo' class='accordion-body collapse'>
			      <div class='accordion-inner'>
			        	<form class='form' method='post' action='' id='password_reset'>
						    <fieldset id='inputs'>
						        <input id='employeeId' name='employeeId' type='text' placeholder='Employee ID' autofocus required><br>   
						        <input id='new_password' name='new_password' type='password' placeholder='New Password' required>
						        <input id='verify_password' name='verify_password' type='password' placeholder='Verify Password' required>
						    </fieldset>
						    <fieldset id='actions'>
						        <input type='submit' class='btn btn-danger' name='submit' value='Reset'>
						    </fieldset>
						</form>
						<div id='response'><h5></h5></div>
			      </div>
			    </div>
			   </div>
			    <div class='accordion-group'>
			    <div class='accordion-heading'>
			      <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapseThree'>
			        Sign-Up
			      </a>
			    </div>
			    <div id='collapseThree' class='accordion-body collapse'>
			      <div class='accordion-inner'>
      		<form method='post' action='sign-up.php' id='register'>
			    <fieldset id='inputs'>
			    	<input id='firstName' name='firstName' type='text' placeholder='First Name' autofocus required>
			        <input id='lastName' name='lastName' type='text' placeholder='Last Name' required>
			        <input id='email1' name='email1' type='email' placeholder='Email' required>
			        <input id='email2' name='email2' type='email' placeholder='Verify Email' required>
			        <input id='employeeId' name='employeeId' type='text' placeholder='Employee ID' required>   
			        <input id='password' autocomplete='off' name='password' type='password' placeholder='Password' required>
			    </fieldset>
			    <fieldset id='select'>
					<select class='select' name='costCenter' id='costCenter'> 
						<option class='option' value=''>---Cost Center---</option>
						<option class='option' value='69333'>Implementation Services</option>
						<option class='option' value='69101'>Cloud Operations</option>
						<option class='option' value='69501'>SIS Operations</option>
						<option class='option' value='69555'>Quality Assurance</option>
						<option class='option' value='69599'>Development</option>
					</select>
			    </fieldset>
			    <fieldset id='actions'>
			        <input type='submit' id='submit'  class='btn btn-primary' value='Register'>
			    </fieldset>
			</form>
			      </div>
			    </div>
			  </div>
			</div>
		</div>	
			

		<hr>

      <footer>
        <!--  <p>&copy; Company 2012</p>  -->
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
    <script src='js/bootstrap.js'></script>
     <script>
     $("#password_reset").submit(function(){
        var formdata = $(this).serialize(); // Serialize all form data

    // Post data to your PHP processing script
    $.post( "pass-reset.php", formdata, function( data ) {
        // Act upon the data returned, setting it to #success <div>
        $("#response").html ( data );
    });

    return false; // Prevent the form from actually submitting
});
</script>

  </body>
</html>
