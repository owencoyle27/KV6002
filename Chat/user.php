<?php require('php_functions/mainfile.php');
require('php_functions/session_checker.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile | Discussin Forum</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="Style/profile.css">
  <link rel="stylesheet" type="text/css" href="Style/navbar.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="text/javascript">
    $(document).ready(function(){
      $(".delete").click(function(){
        var pid = $(this).attr('id');
        var id= $(".postid").attr('id');

        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/deletereply.php",
          data: {replyid:id,postid:pid},
          success: function (response) {
            location.reload();
          }
        });
      });

      $(".ignore_comment").click(function(){
        var pid = $(this).attr('id');
        var id= $(".postid").attr('id');

        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/ignore_comment.php",
          data: {replyid:id,postid:pid},
          success: function (response) {
            location.reload();
          }
        });
      });

      $(".acceptadmin").click(function(){
        var id= $(this).attr('id');
        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/confirm_admin.php",
          data: {userid:id},
          success: function (response) {
            location.reload();

          }
        });
      });


      $(".deleteadmin").click(function(){

        var id= $(this).attr('id');

        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/delete_admin.php",
          data: {userid:id},
          success: function (response) {
            location.reload();
          }
        });
      });

      $(".postdelete").click(function(){

        var pid = $(this).attr('id');

        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/deletepost.php",
          data: {postid:pid},
          success: function (response) {
            location.reload();
          }
        });
      });
    });
  </script>
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
                echo '
               <a href="logout.php" class="nav-item nav-link"><i style="color: #fff;" class="fa fa-sign-out fa-lg"></i></a>';
              }
              ?>
        </div>
      </div>
    </div>
  </nav>

<div class="container" style="border:1px solid #000;width: 100%;min-height: 100vh;">

<div class="row">
    <div class="col-md-4">
        <img class="rounded-circle mt-2" src="images/default_profile.png" width="100%" min-height="200px" max-height="200px" />
    </div>

    <div class="col-md-8 p-5" style="margin-top:5%; ">
      <p style="float:right;"><a class="rounded-pill btn btn-dark btn-md pr-3 pl-3"><?php echo $_SESSION['accounttype'] ?></a></p>
      <h2 style="color: #000"><?php echo $_SESSION['username'] ?></h2>

        <h5></h5>
        <p style="color: #000;">- Joined since

          <?php echo date('M j Y ', strtotime($_SESSION['date'])); ?></p>


    </div>

</div>
<br />

<div class="row pb-5">
    <div class="col-12">

<center>

                                <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-color:#fff !important;">
                                <li class="nav-item">
                                    <a style="color: #000 !important;" class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a style="color: #000 !important;" class="nav-link" id="post-tab" data-toggle="tab" href="#post" role="tab" aria-controls="profile" aria-selected="false">Posts</a>
                                </li>
                                <li class="nav-item">
                                    <a style="color: #000 !important;" class="nav-link" id="reply-tab" data-toggle="tab" href="#reply" role="tab" aria-controls="profile" aria-selected="false">Comments</a>
                                </li>


                                <?php if($_SESSION['accounttype'] == "Admin"){

echo '

                                <li class="nav-item">
                                    <a style="color: #000 !important;" class="nav-link" id="reply-tab" data-toggle="tab" href="#reported-reply" role="tab" aria-controls="profile" aria-selected="false">Reported Comments</a>
                                </li>



                                <li class="nav-item">
                                    <a style="color: #000 !important;" class="nav-link" id="amdin-tab" data-toggle="tab" href="#admin-requests" role="tab" aria-controls="profile" aria-selected="false">Admin Requests </a>
                                </li>
                            </ul>

                            ';


                        } ?>


</center>


<br />

                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                                    <div class="row">
                                                    <div class="col-6">
                                                    <label>User Id</label>
                                                    </div>
                                                    <div class="col-6">
                                                    <p><?php echo $_SESSION['id'] ?></p>
                                                    </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-6">
                                                    <label>Email</label>
                                                    </div>
                                                    <div class="col-6">
                                                    <p><?php echo $_SESSION['email'] ?></p>
                                                    </div>
                                                    </div>


                                                    <div class="row">
                                                    <div class="col-6">
                                                    <label>Account type</label>
                                                    </div>
                                                    <div class="col-6">
                                                    <p><?php echo $_SESSION['accounttype'] ?></p>
                                                    </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-6">
                                                    <label>Posts</label>
                                                    </div>
                                                    <div class="col-6">
                                                    <p>
                                                          <?php  $act = new database; $act->showtotalposts() ;?>

                                                    </p>
                                                    </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-6">
                                                    <label>Replies</label>
                                                    </div>
                                                    <div class="col-6">
                                                    <p><?php  $act = new database; $act->showtotalreply() ;?></p>
                                                    </div>
                                                    </div>



                            </div>
                            <div class="tab-pane fade" id="post" role="tabpanel" aria-labelledby="profile-tab">



<?php $act = new database;
  $act->showmyposts() ?>



                            </div>

                            <div class="tab-pane fade" id="reply" role="tabpanel" aria-labelledby="profile-tab">


<?php $act = new database;
  $act->showmycomments();
  ?>

                            </div>



                            <div class="tab-pane fade" id="reported-reply" role="tabpanel" aria-labelledby="profile-tab">

<?php $act = new database;
 echo $act->showreportedcomments() ?>


                            </div>


                            <div class="tab-pane fade" id="admin-requests" role="tabpanel" aria-labelledby="profile-tab">


<?php $act = new database;
 echo $act->showadminrequests() ?>



                            </div>


                        </div>




    </div>

</div>



</div>
