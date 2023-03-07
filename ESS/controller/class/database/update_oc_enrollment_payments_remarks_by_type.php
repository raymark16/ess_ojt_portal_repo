<?php 
	require_once('../configuration/connection.php');
	$receipt_id = $_POST['receipt_id'];
	$remarks  = $_POST['remarks'];
	$sql = "UPDATE `oc_enrollment_payments` 
			SET    `payment_remarks` = '".$remarks."'
			WHERE  `id`      = ".$receipt_id;

	mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));

	if(mysqli_affected_rows($dbConn) != 0) // IF REGISTRATION IS SUCCESSFUL
	{
		echo 'Ok';
	}
	else
	{
		echo 'Error';
	}

	mysqli_close($dbConn);
?>