<?php
//require 'vendor/autoload.php';
session_start();
require 'php_functions/mainfile.php';
$db = new database();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main | Discussin Forum</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="Style/main.css">
		<link rel="stylesheet" type="text/css" href="Style/navbar.css">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
    <script src="Script/main.js"></script>
<meta content="width=device-width, initial-scale=1" name="viewport" />



<body>
  <?php include "newNav.php" ?>

    <div class="heroBannerOuter">
        <img class="heroBanner" src="images/heroBanner.png" alt="forum hero banner">
        <h1 class="dashboardHeading"> . </h1>
    </div>

	<style> 

	.heroBannerOuter{
        box-sizing: border-box;
        width: 100%;
        height: 250px;
        overflow: hidden;
        margin-top: -10px;
    }

    .heroBanner{
        width: 100%;
        height: 250px;
        object-fit: cover;
        overflow: hidden;
    }

    .heroBannerOuter:after {
        content: '';
        position: relative;
        width: 100%; 
        height: 250px;
        margin-top: -250px;
        display: inline-block;
        background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0, 0, 0, 6) 100%); 
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.6))); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0, 0, 0, 0.6) 100%); 
        background: -ms-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.6) 100%); 
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.6) 100%); 
    }

    .dashboardHeading{
        color: white;
        width: 70%;
        margin: -50px auto 0px;
        font-size: 220%;
        position: relative;
        z-index: 10;
    }

    @media only screen and (max-width: 800px) {
        .heroBanner{
            height: 250px;
        }

        .dashboardHeading{
            width: 100%;
            text-align: center;
        }
    }
</style>

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
                        echo '
                        <a href="logout.php" class="nav-item nav-link"><i style="color: #fff;" class="fa fa-sign-out fa-lg"></i></a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <section class="search-banner form-arka-plan" id="search-banner">
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card acik-renk-form">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-6 col-md-5">
                                        <div class="form-group ">
                                        <label>Title : </label>
                                            <center><input type="text" id="title" name="title" placeholder="Title" style="width: 100%;"></center>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-group ">
                                        <label>Category : </label>
                                        <center><select id="category" name="category" class="order-form-input mb-1" placeholder="Category " required >
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

                                        </select></center>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group ">
                                            <center> <button type="submit" style="margin-top:27px;background-color: #000; " class="btn btn-dark button  pl-5 pr-5">Search</button></center>
                                        </div>
                                    </div>
                                </div>
                            </form>

                           <a style="position:absolute;color: #000; bottom:15px; right:100px;" href="">Clear Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Here the list of discussions will be apperaed -->
    <br />
    <div class="container mb-4" id="postdisplayer">
    </div>
  </div>
</div>
</body>
</html>
