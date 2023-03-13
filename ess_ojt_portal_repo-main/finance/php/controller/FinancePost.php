<?php

session_start();

include '../configuration/connection-config.php';

if ($_POST['type'] == 'PAYMENT_REMARKS') {
	$receipt_id = $_POST['receipt_id'];
	$remarks = $_POST['remarks'];
	$qry = "UPDATE `oc_enrollment_payments`
				SET    `payment_remarks` = '$remarks'
				WHERE  `receipt_id` = '$receipt_id'";

	$rsreg = $dbConn->query($qry);
	// $fetch = $rsreg->fetch_all(MYSQLI_ASSOC);
}

if ($_POST['type'] == 'PROCESS_STUDENT') {
	$userid = $_POST['process_id'];

	$qry = "UPDATE `school_enrollment_pre_registration` 
                SET `schlenrollprereg_verification` = 3
                WHERE `schlenrollprereg_id` = '$userid'";

	mysqli_query($dbConn, $qry);

	$status = "UPDATE school_enrollment_pre_registration 
                        SET schlenrollprereg_status = 4
                        WHERE `schlenrollprereg_id` = $userid";

	mysqli_query($dbConn, $status);


	// if (mysqli_affected_rows($dbConn) > 0) {
	// 	echo "<script type='text/javascript'>alert('Student is Processed Successfully')</script>";
	// 	echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
	// } else {
	// 	echo "<script type='text/javascript'>alert('Processing Student is not Successful')</script>";
	// 	echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
	// }
}

if ($_POST['type'] == 'SEND_COE') {
	$userid = $_POST['enroll_id'];

	$qry = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_verification = 4
                WHERE schlenrollprereg_id = $userid";

	mysqli_query($dbConn, $qry);

	// if (mysqli_affected_rows($dbConn) > 0) {
	// 	echo "<script type='text/javascript'>alert('Student is Enrolled Successfully')</script>";
	// 	echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
	// } else {
	// 	echo "<script type='text/javascript'>alert('Enrolling Student is not Successful')</script>";
	// 	echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
	// }
}

if ($_POST['type'] == 'VERIFY_PAYMENT') {
	$receipt_id = $_POST['receipt_id'];
	$qry = "UPDATE `oc_enrollment_payments`
				SET    `payment_status` = 1
				WHERE  `receipt_id` = '$receipt_id'";

	$rsreg = $dbConn->query($qry);
	// $fetch = $rsreg->fetch_all(MYSQLI_ASSOC);
}

$dbConn->close();
?>