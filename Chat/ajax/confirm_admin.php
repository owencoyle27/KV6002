<?php 

include '../php_functions/mainfile.php';
session_start();
$act = new database;
 echo $act->confirm_admin($_POST['userid']);
 

 ?>