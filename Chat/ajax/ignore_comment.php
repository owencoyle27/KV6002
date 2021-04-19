<?php 

include '../php_functions/mainfile.php';
session_start();
$act = new database;
 echo $act->ignore_comment($_POST['replyid'],$_POST['postid']);
 

 ?>