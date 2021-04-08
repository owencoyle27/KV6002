<?php 

include '../php_functions/mainfile.php';
session_start();
$act = new database;
 echo $act->devote($_POST['postid']);
 

 ?>