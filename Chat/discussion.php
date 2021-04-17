<?php
require('php_functions/mainfile.php');
session_start();

//hide warning message
error_reporting(0);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Disscusion | Discussin Forum</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="Style/main.css">
  <link rel="stylesheet" type="text/css" href="Style/navbar.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
  <script type="text/javascript">
    $(document).ready(function(){

      var limit = 4;


      $(document).on("click",".delete", function () {
        var id = $(this).attr('id');
        var pid= <?php echo $_GET['id'] ?> ;

        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/deletereply.php",
          data: {replyid:id,postid:pid},
          success: function (response) {
            location.reload();
          }
        });
      });

      $(document).on("click",".report", function () {

            var id = $(this).attr('id');
            var pid= <?php echo $_GET['id'] ?>  ;

            if(confirm("Are you sure you want to report ?") == true){

            $.ajax({ //create an ajax request to load_page.php
              type:'POST',
            url:"ajax/report_comment.php",
                data: {replyid:id,postid:pid},
                success: function (response) {
            if(response == 1){
              alert('The comment has been reported. Thank You !');
            }
            else{
              alert('The comment has already been reported.');
            }
          }
        });
          }

      });

      $(".upvote").click(function(){
        var pid= <?php echo $_GET['id'] ?>  ;
        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/upvote.php",
          data: {postid:pid},
          success: function (response) {

            var res = $.parseJSON(response);
            if(res.check == 1){
            $('.upvote').css('background-color' , '#90ee90');
          }else{
            $('.upvote').css('background-color' , 'white');

          }
            $('.devote').css('background-color' , 'white');

           $(".upcount").text(res.upvotes);
           $(".downcount").text(res.devotes);
          }
        });
      });

      $(".devote").click(function(){
        var pid= <?php echo $_GET['id'] ?>  ;
        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/devote.php",
          data: {postid:pid},
          success: function (response) {
                        var res = $.parseJSON(response);
                        if(res.check == 1){
            $('.devote').css('background-color' , '#ffcccb');
          }else{
            $('.devote').css('background-color' , 'white');

          }
            $('.upvote').css('background-color' , 'white');

           $(".upcount").text(res.upvotes);
           $(".downcount").text(res.devotes);
          }
        });
      });

      $(".deletepost").click(function(){
        var pid= <?php echo $_GET['id'] ?>  ;
        $.ajax({ //create an ajax request to load_page.php
          type:'POST',
          url:"ajax/deletepost.php",
          data: {postid:pid},
          success: function (response) {
            window.location = "index.php";

          }
        });
      });

      $("#sort").on('change', function(){
        var sort = $(this).val();
        var pid= <?php echo $_GET['id'] ?> ;
        $.ajax({
          type:'POST',
          url:"ajax/sortposts.php",
          data: {sort:sort,postid:pid,limit:limit},
          success: function (response) {
            $(".replies").html(response);
          }
        });
      });

      var sort = $("#sort").val();
      var pid= <?php echo $_GET['id'] ?> ;
      $.ajax({
        type:'POST',
        url:"ajax/sortposts.php",
        data: {sort:sort,postid:pid,limit:limit},
        success: function (response) {
          $(".replies").html(response);
        }
      });
   


 $(document).on("click","#seemore", function () {
        var sort = $("#sort").val();
        var pid= <?php echo $_GET['id'] ?> ;
        limit=limit+4;
$.ajax({
        type:'POST',
        url:"ajax/sortposts.php",
        data: {sort:sort,postid:pid,limit:limit},
        success: function (response) {
          $(".replies").html(response);
        }
      });
    });
 });

  </script>
</head>
<body style="background-color: #eee;">
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
  <?php
    if(isset($_GET['id'])){
      $act = new database;
      $act->show_project($_GET['id']);
    }
  ?>
  <div class="replies" style="margin-bottom: 120px" ></div>
</div>

<?php if (isset($_SESSION['id'])) {
    echo '<form style="position: fixed; bottom: 0px;display: inline;width: 100%;" method="post" action="ajax/comment.php">
      <div style="padding:30px;border: 1px solid #e4d9ff;background-color: #e4d9ff;">
          <center>
            <input type="number" hidden name="post_id" value="'.$_GET['id'].'">
            <input name="comment" type="text" style="width: 70%" placeholder="Comment">
            <button type="submit" style="width: 20%;margin-top: -6px;" class="btn btn-lg btn-primary" >Reply</button>
          </center>
        </div>
      </form>';
  }
?>
