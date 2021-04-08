<?php
session_start();

if(isset($_SESSION['id'])){
}else{
	echo '<script type="text/javascript">
																		window.location = "login.php"
																		</script>';
}

?>