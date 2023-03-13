<?php 
error_reporting(E_ALL & ~ E_NOTICE);
	session_start();
	//session_destroy();
	if(isset($_SESSION["USERID"])){
		header('Location: login.php');
		exit();
	} else {
        header('Location: login.php');
        exit();
	}
 ?>