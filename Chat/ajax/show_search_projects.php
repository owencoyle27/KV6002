<?php 

include '../php_functions/mainfile.php';

$act = new database;
 echo $act->show_search_projects($_POST['title'],$_POST['cat'],$_POST['sdata']);
 

 ?>