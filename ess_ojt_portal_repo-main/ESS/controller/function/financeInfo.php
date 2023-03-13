<?php

   session_start();

	include '../class/configuration/connection.php';

	if ($_GET['type'] == 'GET_PARENT')
	{
		$qry = "SELECT 	*
				FROM 	`oc_parents` 
				WHERE 	`account_id` = " . $_SESSION['account_id'] . " AND 
						`relation`   = '" . $_GET['parent'] . "' ";

		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_array(MYSQLI_ASSOC);

	}

	$dbConn->close();
	echo json_encode($fetch);
	
?>