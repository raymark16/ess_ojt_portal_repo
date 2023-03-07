<?php
session_start();

include '../configuration/connection-config.php';

if ($_GET['type'] == 'STUD_INFO') {
	$qry = "SELECT 	DATE_FORMAT(`reg`.`schlenrollprereg_regdate`, '%M %d, %Y') AS `REG_DATE`,
						UPPER(CONCAT(`ocuser`.`last_name`, ', ', `ocuser`.`first_name`)) `NAME`,
						UPPER(`ocuser`.`student_type`)`STUDENT_TYPE`,
						UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
						UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
						UPPER(`crse`.`schlacadcrse_code`) `CRSE_NAME`, 
						`reg`.`schlusr_id` `USER_ID`,
						`reg`.`schlenrollprereg_id` `REG_ID`,
						`ocuser`.`id` `OC_USER_ID`,
						`reg`.`schlenrollprereg_verification` `REG_STATUS`, 
						`ocuser`.`verified` `OC_STATUS` 

				FROM `oc_user_accounts` `ocuser`

					LEFT JOIN `school_enrollment_pre_registration` `reg`
						ON 	`reg`.`schlenrollprereg_emailadd` = `ocuser`.`emailaddress`

					LEFT JOIN `school_academic_level` `lvl`
						ON 	`reg`.`acadlvl_id`=`lvl`.`schlacadlvl_id`

					LEFT JOIN `school_academic_year_level` `yrlvl`
						ON 	`reg`.`acadyrlvl_id`=`yrlvl`.`schlacadyrlvl_id`

					LEFT JOIN `school_academic_course` `crse`
						ON 	`reg`.`acadcrse_id`=`crse`.`schlacadcrse_id`
						
					LEFT JOIN `school_users` `usr`
						ON 	`reg`.`schlusr_id`=`usr`.`schlusr_id` 

				WHERE 	`reg`.`schlenrollprereg_verification` >= 2 	AND 
						`reg`.`acadyr_id` = 1 AND 
						`reg`.`acadprd_id` = 2
						
				ORDER BY 	`reg`.`schlenrollprereg_regdate` DESC,
							`ocuser`.`verified` DESC";

	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
}

if ($_GET['type'] == 'GET_PD') {
	$reg_id = $_GET['reg_id'];
	$qry = "SELECT `payment_submitted_date` `PAYMENT_SUBMITTED_DATE`,
		`registration_id` `REG_ID`,
		`transaction_type` `TRANSACTION_TYPE`,
		`bank` `BANK`,
		`amount` `AMOUNT`,
		`transaction_date` `TRANSACTION_DATE`,
		`reference_number` `REFERENCE_ID`,
		`payment_status` `PAYMENT_STATUS`,
		`receipt_id` `RECEIPT`,
		`schlenrollprereg_verification`,
		`payment_remarks`
		FROM `oc_enrollment_payments`
		LEFT JOIN school_enrollment_pre_registration ON `oc_enrollment_payments`.`registration_id` = `school_enrollment_pre_registration`.`schlenrollprereg_id` WHERE `registration_id` = '$reg_id'";

	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
}

if ($_GET['type'] == 'PROCESS_STUD') {
	$reg_id = $_GET['reg_id'];
	$qry = "SELECT `payment_submitted_date` `PAYMENT_SUBMITTED_DATE`,
		`registration_id` `REG_ID`,
		`transaction_type` `TRANSACTION_TYPE`,
		`bank` `BANK`,
		`amount` `AMOUNT`,
		`transaction_date` `TRANSACTION_DATE`,
		`reference_number` `REFERENCE_ID`,
		`payment_status` `PAYMENT_STATUS`,
		`receipt_id` `RECEIPT`,
		`schlenrollprereg_verification`
		FROM `oc_enrollment_payments`
		LEFT JOIN school_enrollment_pre_registration ON `oc_enrollment_payments`.`registration_id` = `school_enrollment_pre_registration`.`schlenrollprereg_id` WHERE `registration_id` = '$reg_id'";

	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
}

if ($_GET['type'] == 'STUD_DETAILS') {
	$receipt_id = $_GET['receipt_id'];
	// $qry = "SELECT `payment_submitted_date` `PAYMENT_SUBMITTED_DATE`,
	// `transaction_type` `TRANSACTION_TYPE`,
	// `bank` `BANK`,
	// `amount` `AMOUNT`,
	// `transaction_date` `TRANSACTION_DATE`,
	// `reference_number` `REFERENCE_ID`,
	// `payment_status` `PAYMENT_STATUS`
	// FROM `oc_enrollment_payments` WHERE `registration_id` = '$reg_id'";
	$qry = "SELECT `schlenrollprereg_lname`,
			`schlenrollprereg_fname`,
			`schlenrollprereg_mname`,
			`schlenrollprereg_suffix`,
			`schlenrollprereg_mobileno`,
			`schlenrollprereg_telno`,
			`schlenrollprereg_emailadd`,
			`transaction_type`,
			`amount`,
			`bank`,
			`reference_number`,
			`transaction_date`,
			`payment_remarks`
			FROM `oc_enrollment_payments` LEFT JOIN `school_enrollment_pre_registration` ON `oc_enrollment_payments`.`registration_id` = `school_enrollment_pre_registration`.`schlenrollprereg_id` WHERE `oc_enrollment_payments`.`receipt_id` = '$receipt_id'";

	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_array(MYSQLI_ASSOC);
}

if ($_GET['type'] == 'VIEW_DOCUMENT') {
	$receipt_id = $_GET['receipt_id'];
	$qry = "SELECT
			`document_location`
			FROM oc_uploaded_documents WHERE `document_id` = '$receipt_id'";

	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_array(MYSQLI_ASSOC);
}

if ($_GET['type'] == 'GET_PAYMENTS') {
	$reg_id = $_GET['reg_id'];
	$qry = "SELECT
			COUNT(`payment_status`)
			FROM oc_enrollment_payments WHERE `registration_id` = '$reg_id'";

	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_array(MYSQLI_ASSOC);
}

if ($_GET['type'] == 'GET_VERIFIED_PAYMENTS') {
	$reg_id = $_GET['reg_id'];
	$qry = "SELECT
			COUNT(`payment_status`)
			FROM `oc_enrollment_payments` WHERE `registration_id` = '$reg_id'  AND `payment_status` = 1";

	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_array(MYSQLI_ASSOC);
}

// if ($_GET['type'] == 'DOWNLOAD_DOCUMENT') {
// 	$id =  $_GET['document_id'];
// 	$qry = "SELECT * FROM oc_uploaded_documents WHERE document_id = '$id'";
// 	$rsuser = $dbConn->query($qry);
// 	$file_info = $rsuser->fetch_ALL(MYSQLI_ASSOC);

// 	$file = $file_info[0];

// 	print_r($file);

// 	$fileName = basename($file['document_location']);

// 	$filePath = $file['document_location'];

// 	echo $fileName;

// 	if (!empty($fileName) && file_exists($filePath)) {
// 		// Define headers 
// 		header("Cache-Control: public");
// 		header("Content-Description: File Transfer");
// 		header("Content-Disposition: attachment; filename=$fileName");
// 		header("Content-Type: application/octet-stream");
// 		header("Content-Transfer-Encoding: binary");
// 		header('Expires: 0');
// 		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// 		header('Pragma: public');
// 		ob_clean();
// 		flush();
// 		// Read the file 
// 		readfile($filePath);
// 		// exit; 
// 	}
// }

$rsreg->free_result();
$dbConn->close();
echo json_encode($fetch);
?>