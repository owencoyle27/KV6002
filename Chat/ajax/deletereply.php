<?php 

include '../php_functions/mainfile.php';
session_start();
$act = new database;
 echo $act->deletecomment($_POST['replyid'],$_POST['postid']);
 

 ?>