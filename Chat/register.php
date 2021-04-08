<!DOCTYPE html>
<html>
<head>
	<title>Register | Discussion Forum</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Style/forms.css">
	<link rel="stylesheet" type="text/css" href="Style/navbar.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
	<script src='https://www.google.com/recaptcha/api.js' async defer ></script>

</head>
<body>
	<?php include "newNav.php" ?>
	
  <nav class="navbar navbar-expand-md navbar-dark ">
    <div class="container">
      <a href="index.php" class="navbar-brand">Discussion Forum</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ml-auto">
              <a href="login.php" class="nav-item nav-link" >Log In</a>
          </div>
      </div>
      </div>
  </nav>
	<div class="container">
		<div class="col-md-6 mx-auto text-center">
		<div class="header-title">
			<h1 class="wv-heading--title">
				Check out — it’s free!
			</h1>
			<h2 class="wv-heading--subtitle">
				Share your thoughts, questions and many more things to explore, Just complete the form below...
			</h2>
		</div>
		</div>
		<div class="row" style="margin-top: -50px;">
		<div class="col-md-4 mx-auto">
			<div class="myform form ">
				<form action="ajax/signupcontroller.php" method="post" name="register">
					<div class="form-group">
					<input type="text" name="username"  class="form-control my-input" id="username" placeholder="username" required>
					</div>

					<div class="form-group">
					<input type="text" name="email"  class="form-control my-input" id="email" placeholder="Email" required>
					</div>

					<div class="form-group">
					<input type="password" min="0" name="pass" id="pass"  class="form-control my-input" placeholder="Password" required>
					</div>

						<div class="form-group">
					<select name="accounttype" class="form-control" required>
					<option>Student</option>
					<option>Admin</option>
					</select>
					</div>

					<div class="form-group">
						<center>
							<div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
						</center>
					</div>

					<p> <?php echo $_GET['error'] ?? "" ?></p>

					<div class="text-center ">
					<button type="submit" class=" btn btn-block send-button tx-tfm">Create Your Free Account</button>
					</div>
					<div class="col-md-12 ">
					<div class="login-or">
						<hr class="hr-or">
						<span class="span-or">or</span>
					</div>
					</div>
					<div class="form-group">
						<a class="btn btn-block g-button" href="login.php">
							<i class="fa fa-google"></i>LogIn
						</a>
					</div>
					<p class="small mt-3">By signing up, you are indicating that you have read and agree to the <b>Terms of Use</b> and <b>Privacy Policy</b>.
					</p>
				</form>
			</div>
		</div>
		</div>
	</div>
</body>
</html>
