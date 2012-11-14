
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">AWS Portal</a>
          <div class="nav-collapse collapse">
            <!-- <ul class="nav">
              <li class="active"><a href="index.php"><i class="icon-home icon-black"></i>Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>  -->
            <ul class="nav pull-right">
            	<li><a href="#sign-up" data-toggle="modal">Sign Up</a></li>
            	<li><a class="hidden-desktop" href="#login" data-toggle="modal">Login</a></li>
     			<li class="dropdown hidden-tablet hidden-phone">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="icon-user"></b>Login<b class="caret"></b></a>
              			<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
									<form id="form" class="form" method="post" action="login-beta.php">
										<fieldset>
  											<label class="UsernameLabel">Email</label>
												<input type="email" id="Form_Email" name="email" value="" class="InputBox">
												<label class="PasswordLabel">Password</label>
												<input type="password" id="Form_Password" name="password" value="" class="InputBox Password">
												<input type="hidden" name"file" value="<?echo $_POST['file']; ?>">
											<input type="submit" id="Form_SignIn" name="Form/Sign_In" value="Sign In" class="btn btn-primary">
										</fieldset>
										<p class="CreateAccount">
											<a align="left" href="#password_reset" data-toggle="modal">Forgot password?</a>
										</p>
									</form>
						</div>
          		</li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
          <div class="hero-unit" align="center">
            <h1>AWS Portal</h1>
            <p>Create new AWS instances, volumes for QA and Development purposes with the help of the AWS APIs, all in real-time.</p>
            <p><a class="btn btn-primary btn-large" href="//aws.amazon.com/what-is-aws/">Learn more &raquo;</a></p>
          </div>
	
      <!-- Example row of columns -->
      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script><!--  
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <!--  <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>  -->

  </body>
</html>
