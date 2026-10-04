
<?php
session_start();
session_unset();

session_destroy();
unset($_COOKIE['remmber_my']);
setcookie("remmber_my","",time()-3600,"/");
	header("Location:login.php");

?>