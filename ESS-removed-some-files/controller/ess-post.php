<?php

session_start();

include './class/configuration/connection-config.php';

if ($_POST['type'] == 'POST_VERIFY') {
	$reg_id = $_POST['reg_id'];
	$esc_or_shs_selected = $_POST['esc_or_shs_selected'];
	$qry = "UPDATE `school_enrollment_pre_registration`
				SET   `schlenrollprereg_verification` = 1, 
                `schlenrollprereg_status` = 1, `esc_or_shs` = '$esc_or_shs_selected'
				WHERE  `schlenrollprereg_id` = '$reg_id'";

	$rsreg = $dbConn->query($qry);

    
}
if ($_POST['type'] == 'POST_PROCESS_STUDENT') {
	$reg_id = $_POST['reg_id'];

    $qry = "UPDATE `school_enrollment_pre_registration`
                SET `schlenrollprereg_verification` = 2,
                `schlenrollprereg_status` = 2
                WHERE `schlenrollprereg_id` = '$reg_id'";

	$rsreg = $dbConn->query($qry);

    
}
if ($_POST['type'] == 'POST_ESS_STAFF_ASSIGNED') {
	$id_of_user_list = $_POST['id_of_user_list'];
	$reg_id_of_student = $_POST['reg_id_of_student'];

    $qry = "UPDATE `school_enrollment_pre_registration`
                SET `schlusr_id` = '$id_of_user_list'
                WHERE `schlenrollprereg_id` = '$reg_id_of_student'";

	$rsreg = $dbConn->query($qry);

    
}

$dbConn->close();
?>