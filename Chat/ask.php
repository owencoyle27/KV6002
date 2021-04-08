<?php require('php_functions/session_checker.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ask Question | Discussin Forum</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="Style/main.css">
  <link rel="stylesheet" type="text/css" href="Style/navbar.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->

  <style type="text/css">
    @media only screen and (max-width: 786px) {
      #tochange{
        padding:10px;
      }
    }

    @media only screen and (min-width: 787px) {
      #tochange{
        padding: 70px;
      }
    }
  </style>
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
              <a href="index.php" class="nav-item nav-link" >Discussion</a>
              <a href="ask.php" class="nav-item nav-link" >Ask</a>

              <a href="user.php" class="nav-item nav-link" >Account</a>

              <?php if(isset($_SESSION['id'])){
                echo '<a href="logout.php" class="nav-item nav-link"><i style="color: #fff;" class="fa fa-sign-out fa-lg"></i></a>';
              }
              ?>
          </div>
      </div>
      </div>
  </nav>
<div class="" >
<div class="" >
  <form action="php_functions/postdiscussion.php" method="post" style="display: inline;width: 100%;">
    <div id="tochange" class="container" style="border: 1px solid #e4d9ff;border: 1px solid black;">
    <h2 style="padding-left:10%;color:#000;">Post your question : </h1> <br />
    <center>
      <input type="text" name="title" style="width: 80%" placeholder="Enter title" required/>
      <br />
      <br />
      <select  style="width: 80%" id="category" name="category" class="order-form-input mb-1" placeholder="Category " required >
        <option value="" disabled selected>--Select your category--</option>
				<option value="Applied Sciences">Applied Sciences</option>
				<option value="Architecture and Built Environment">Architecture and Built Environment</option>
				<option value="Arts">Arts</option>
				<option value="Computer and Information Sciences">Computer and Information Sciences</option>
				<option value="Geography and Environmental Sciences">Geography and Environmental Sciences</option>
				<option value="Humanities">Humanities</option>
				<option value="Mathematics, Physics and Electrical Engineering">Mathematics, Physics and Electrical Engineering</option>
				<option value="Mechanical and Construction Engineering">Mechanical and Construction Engineering</option>
				<option value="Newcastle Business School">Newcastle Business School</option>
				<option value="New Students">New Students</option>
				<option value="Northumbria Law School">Northumbria Law School</option>
				<option value="Northumbria School of Design">Northumbria School of Design</option>
				<option value="Nursing, Midwifery & Health">Nursing, Midwifery & Health</option>
				<option value="Psychology">Psychology</option>
				<option value="Social Sciences">Social Sciences</option>
				<option value="Social Work, Education & Community Wellbeing">Social Work, Education & Community Wellbeing</option>
				<option value="Sport, Exercise and Rehabilitation">Sport, Exercise and Rehabilitation</option>
        <option value="Off Topic">Off Topic</option>

      </select>
      <br /><br />
    </center>
    <center>
      <textarea required cols="45" rows="10" type="text" name="description" style="width: 80%" placeholder="Ask Your Question Here..."></textarea>
      <br />
      <br />
      <p> <?php echo $_GET['error'] ?? "" ?> </p>
      <button type="submit" style="width: 20%;background-color: #000;" class="btn btn-lg btn-dark" >Post</button>
    </center>
    </div>
  </form>
</div>
