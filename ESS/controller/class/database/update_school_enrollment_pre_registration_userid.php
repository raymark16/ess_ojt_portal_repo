<?php 
	require_once('../configuration/connection.php');
	$userid = $_POST['userid'];
	$regid  = $_POST['regid'];
	$sql = "UPDATE `school_enrollment_pre_registration` SET
			`schlusr_id` = ".$userid." WHERE `schlenrollprereg_id` = ".$regid;
	try{
		$stmt = $dbConn->prepare($sql);
		$stmt->execute();
		$last_id = mysqli_insert_id($dbConn);
		
	}catch (Exception $e){
		echo 'Error';
	}
	//echo '<div>test</div>';
	mysqli_close($dbConn);
	echo 'Ok';
?>