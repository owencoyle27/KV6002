<?php
	
$con = new mysqli("localhost", "root", "", "php_forum");
if ($con->connect_errno) {
	echo "failed (".$con->connect_errno.")".$con->connect_errno;
}
?>