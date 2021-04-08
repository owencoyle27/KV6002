<?php
require '../php_functions/mainfile.php';
$act = new database();
echo $act->showposts($_POST['sdata']);
?>