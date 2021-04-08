<?php 
  include 'mainfile.php';
  session_start();
  $act = new database;
  echo $act->post($_POST['title'],$_POST['category'],$_POST['description']);
?>