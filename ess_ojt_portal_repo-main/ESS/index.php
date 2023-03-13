<?php 
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