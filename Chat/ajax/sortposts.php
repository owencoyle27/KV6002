<?php 

include '../php_functions/mainfile.php';
session_start();
$act = new database;
 echo $act->sort_posts($_POST['postid'],$_POST['sort'],$_POST['limit']);
 

 ?>