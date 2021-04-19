<?php 
  include '../php_functions/mainfile.php';
  session_start();
  $act = new database;
  echo $act->comment($_POST['comment'],$_POST['post_id']);
?>