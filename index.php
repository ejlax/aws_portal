<!DOCTYPE html>
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
        padding-top: 60px;
        padding-bottom: 40px;
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
            <!-- <ul class='nav'>
              <li class='active'><a href='index.php'><i class='icon-home icon-black'></i>Home</a></li>
              <li><a href='#about'>About</a></li>
              <li><a href='#contact'>Contact</a></li>
            </ul>  -->
            <ul class='nav pull-right'>
            	<li><a href='#sign-up' data-toggle='modal'>Sign Up</a></li>
            	<li><a class='hidden-desktop' href='#stack1' data-toggle='modal'>Login</a></li>
     			<li class='dropdown hidden-tablet hidden-phone'>
            		<a href='#' class='dropdown-toggle' data-toggle='dropdown'><b class='icon-user'></b>Login<b class='caret'></b></a>
              			<div class='dropdown-menu' style='padding: 15px; padding-bottom: 0px;'>
									<form id='form' class='form' method='post' action='login-beta.php'>
										<fieldset>
  											<label class='UsernameLabel'>Email</label>
												<input type='email' id='Form_Email' name='email' value='' class='InputBox'>
												<label class='PasswordLabel'>Password</label>
												<input type='password' id='Form_Password' name='password' value='' class='InputBox Password'>
												<input type='hidden' name'file' value='<?echo $_POST['file']; ?>'>
											<input type='submit' id='Form_SignIn' name='Form/Sign_In' value='Sign In' class='btn btn-primary'>
										</fieldset>
									</form>
						</div>
          		</li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<?php
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
if($_GET['message'] == 3){
	$message = 'Thank you for signing up. Please login.';
	echo "    	    <div class='alert alert-success'>
	  <button type='button' class='close' data-dismiss='alert'>×</button>
	  <h4 align='center'>".$message."</h4>
			</div>";
}
?>
			
	<div class='container'>
          <div class='hero-unit' align='center'>
            <h1>AWS Portal</h1>
            <p>Create new AWS instances, volumes for QA and Development purposes with the help of the AWS APIs, all in real-time.</p>
            <p><a class='btn btn-primary btn-large' href='//aws.amazon.com/what-is-aws/'>Learn more &raquo;</a></p>
          </div>

      <div class='modal hide fade' id='stack2'>
      		<div class='modal-header'>
      			<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
      			<p align='center'><h2>Password Reset</h2></p>
      		</div>
      		<div class='modal-body'>
      			<form class='form' method='post' action='pass-reset.php' id='password_reset'>
				    <fieldset id='inputs'>
				        <input id='employeeId' name='employeeId' type='text' placeholder='Employee ID' autofocus required><br>   
				        <input id='new_password' name='new_password' type='password' placeholder='New Password' required>
				        <input id='verify_password' name='verify_password' type='password' placeholder='Verify Password' required>
				    </fieldset>
				    <fieldset id='actions'>
				        <input type='submit' class='btn btn-danger' name='submit' value='Reset'>
				    </fieldset>
				</form>
      		</div>
      </div>
      <div class='modal hide fade' id='sign-up'>
      	<div class='modal-header'>
      		<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
      		<p align='center'><h2>Sign Up</h2></p>
      	</div>
      	<div class='modal-body'>
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
      <div class='modal hide fade' id='stack1'>
      	<div class='modal-header'>
      		<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
      		<p><h2>Login</h2></p>
      	</div>
      	<div class='modal-body'>
      							<form id='form' class='form' method='post' action='login-beta.php'>
										<fieldset>
  											<label class='UsernameLabel'>Email</label>
												<input type='email' id='Form_Email' name='email' value='' class='InputBox' required>
												<label class='PasswordLabel'>Password</label>
												<input type='password' id='Form_Password' name='password' value='' class='InputBox Password' required>
												<input type='hidden' name'file' value='<?if(isset($_GET['file'])){echo $_GET['file'];} ?>'>
											<input type='submit' id='Form_SignIn' name='Form/Sign_In' value='Sign In' class='btn btn-primary'>
										</fieldset>
										<p class='CreateAccount'>
											<a align='left' href='#stack2' data-toggle='modal'>Forgot password?</a>
										</p>
									</form>
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
    <script src='js/bootstrap-manager.js'</script>
    	<script src='js/bootstrap-modal.js'></script>
    	<script id="dynamic" type="text/javascript">
$('.dynamic .demo').click(function(){
  var tmpl = [
    // tabindex is required for focus
    '<div class="modal hide fade" tabindex="-1">',
      '<div class="modal-header">',
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
        '<h3>Modal header</h3>', 
      '</div>',
      '<div class="modal-body">',
        '<p>Test</p>',
      '</div>',
      '<div class="modal-footer">',
        '<a href="#" data-dismiss="modal" class="btn">Close</a>',
        '<a href="#" class="btn btn-primary">Save changes</a>',
      '</div>',
    '</div>'
  ].join('');
  
  $(tmpl).modal();
});
</script>

<script id="custom-manager" type="text/javascript">
// provide the container for all assigned modals to the manager
var myManager = new ModalManager($('.custom-manager'));

$('.custom-manager .demo').on('click', function(){
  // helper function for modal creation
  myManager.createModal($('#myModal')); 
  
  /* Alternatively:
  $('#myModal').modal({ manager: myManager });
  */
});
</script>

<script id="ajax" type="text/javascript">
// NOTE: modal must be in the DOM before calling .load()
var $modal = $('#ajax-modal');

$('.ajax .demo').on('click', function(){
  // create the backdrop and wait for next modal to be triggered
  GlobalModalManager.loading();

  setTimeout(function(){
     $modal.load('modal_ajax_test.html', '', function(){
      $modal.modal();
    });
  }, 1000);
});

$modal.on('click', '.update', function(){
  $modal.modal('loading');
  setTimeout(function(){
    $modal
      .modal('loading')
      .find('.modal-body')
        .prepend('<div class="alert alert-info fade in">' +
          'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        '</div>');
  }, 1000);
});

</script>

  </body>
</html>

