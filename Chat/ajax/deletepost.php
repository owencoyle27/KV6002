<?php 

include '../php_functions/mainfile.php';
session_start();
$act = new database;
 echo $act->delete_post($_POST['postid']);
 

 ?>