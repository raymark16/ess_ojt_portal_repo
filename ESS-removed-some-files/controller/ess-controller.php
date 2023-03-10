<?php
	require('class/configuration/connection.php');
	include('class/configuration/server.php');

	if(!isset($_SESSION['USERID']))
	{
		header('location: login.php');
	}

	if (isset($_GET['logout'])) 
	{	
		session_destroy();
	
		unset($_SESSION['USERNAME']);
		unset($_SESSION['FIRST_NAME']);
		unset($_SESSION['LAST_NAME']);
		unset($_SESSION['POSITION']);
		unset($_SESSION['USERID']);
		
		header('location: login.php');
		exit();
  	}

  	
?>