<?php  
	require_once("configuration-config.php");
	$dbConn = mysqli_connect($servername,$serverusername,$serverpassword,$serverdb);

	if (!$dbConn)
	{
	die("Connection failed: " . mysqli_connect_error());
	}

	$dbConn = new mysqli($servername,$serverusername,$serverpassword,$serverdb);

?>
