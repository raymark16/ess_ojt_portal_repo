
<?php
	session_start();
	require('class/configuration/connection.php');
	include('class/configuration/server.php');
	
	if ($_GET['type'] == 'ESS-STAFF') {
		$qry = "SELECT `schlusr_lname` `NAME`,
				       `schlusr_id` `ESS_ID`
				FROM `school_users`
					WHERE `schlusr_status` = 1 
					AND `schlusr_isactive` = 1
					AND `schlusr_acclvl` = 1
					OR `schlusr_acclvl` = 2";
	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	}

	if ($_GET['type'] == 'INFO') {
		$qry = "	SELECT `reg`.`schlenrollprereg_regdate` `REG_DATE`,
						UPPER(CONCAT(`reg`.`schlenrollprereg_lname`, ', ', `reg`.`schlenrollprereg_fname`)) `NAME`,
						UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
						UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
						UPPER(`crse`.`schlacadcrse_code`) `CRSE_NAME`, 
						`reg`.`student_type` `STUD_TYPE`,
						`reg`.`schlusr_id` `ESS_ID`,
						`reg`.`schlenrollprereg_verification` `STATUS`, 
						`reg`.`schlenrollprereg_id` `ID`
	
					FROM `school_enrollment_pre_registration` `reg`
	
						LEFT JOIN `school_academic_level` `lvl`
							ON `reg`.`acadlvl_id`=`lvl`.`schlacadlvl_id`
						LEFT JOIN `school_academic_year_level` `yrlvl`
							ON `reg`.`acadyrlvl_id`=`yrlvl`.`schlacadyrlvl_id`
						LEFT JOIN `school_academic_course` `crse`
							ON `reg`.`acadcrse_id`=`crse`.`schlacadcrse_id`
						LEFT JOIN `school_users` `usr`
							ON `reg`.`schlusr_id`=`usr`.`schlusr_id` 
						WHERE 	`reg`.`schlenrollprereg_verification` < 3 AND 
							`reg`.`acadyr_id` = 1 AND 
							`reg`.`acadprd_id` = 1
						
					ORDER BY 	`reg`.`schlenrollprereg_verification` DESC, 
								`reg`.`schlenrollprereg_regdate` DESC";
						
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	}
    if ($_GET['type'] == 'STUD_DETAILS'){
		$registration_id = $_GET['reg_id'];
		$qry = "SELECT `schlenrollprereg_lname`,
		`schlenrollprereg_fname`,
		`schlenrollprereg_mname`,
		`schlenrollprereg_suffix`,
		`schlacadyrlvl_name`,
		`school_academic_year_level`.`schlacadyrlvl_id` AS `schoolacadyearlevel_id`,
		`student_type`,
		`studium_type`,
		`last_school_sector`,
		`schlenrollprereg_age`,
		`schlenrollprereg_gender`,
		`schlenrollprereg_bdate`,
		`schlenrollprereg_bplace`,
		`schlenrollprereg_nationality`,
		`schlenrollprereg_religion`,
		`schlenrollprereg_mothertongue`,
		`schlenrollprereg_civilstatus`,
		`schlenrollprereg_noofsiblings`,
		`schlenrollprereg_mobileno`,
		`schlenrollprereg_telno`,
		`schlenrollprereg_emailadd`,
		`schlenrollprereg_present_streetadd`,
		`schlenrollprereg_permanent_streetadd`,
		`schlenrollprereg_present_zipcode`,
		`schlenrollprereg_permanent_zipcode`,
		`present_province`.`philarealocprov_name` AS `present_province_name`,
		`present_municipality`.`philarealocmun_name` AS `present_municipality_name`,
		`present_barangay`.`philarealocbrgy_name` AS `present_barangay_name`,
		`permanent_province`.`philarealocprov_name` AS `permanent_province_name`,
		`permanent_municipality`.`philarealocmun_name` AS `permanent_municipality_name`,
		`permanent_barangay`.`philarealocbrgy_name` AS `permanent_barangay_name`,
		`schlacadlvl_code`,
		`schlacadcrse_name`
		FROM `school_enrollment_pre_registration` 
		LEFT JOIN school_academic_level ON school_academic_level.schlacadlvl_id = school_enrollment_pre_registration.acadlvl_id 
		LEFT JOIN school_academic_course ON school_academic_course.schlacadcrse_id = school_enrollment_pre_registration.acadcrse_id
		LEFT JOIN school_academic_year_level ON school_academic_year_level.schlacadyrlvl_id = school_enrollment_pre_registration.acadyrlvl_id
		LEFT JOIN philippine_area_location_province AS present_province ON present_province.philarealocprov_id = school_enrollment_pre_registration.philarealocprov_present_id
		LEFT JOIN philippine_area_location_municipality AS present_municipality ON present_municipality.philarealocmun_id = school_enrollment_pre_registration.philarealocmun_present_id
		LEFT JOIN philippine_area_location_barangay AS present_barangay ON present_barangay.philarealocbrgy_id = school_enrollment_pre_registration.philarealocbrgy_present_id
		LEFT JOIN philippine_area_location_province AS permanent_province ON permanent_province.philarealocprov_id = school_enrollment_pre_registration.philarealocprov_permanent_id
		LEFT JOIN philippine_area_location_municipality AS permanent_municipality ON permanent_municipality.philarealocmun_id = school_enrollment_pre_registration.philarealocmun_permanent_id
		LEFT JOIN philippine_area_location_barangay AS permanent_barangay ON permanent_barangay.philarealocbrgy_id = school_enrollment_pre_registration.philarealocbrgy_permanent_id      
		WHERE `school_enrollment_pre_registration`.`schlenrollprereg_id` = '$registration_id'";
		
		
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_array(MYSQLI_ASSOC);
	}
	// if ($_GET['type'] == 'ESS-STAFF') {
	// 	$qry = "SELECT `schlusr_lname` `NAME`,
	// 			       `schlusr_id` `ESS_ID`
	// 			FROM `school_users`
	// 				WHERE `schlusr_status` = 1 
	// 				AND `schlusr_isactive` = 1
	// 				AND `schlusr_acclvl` = 1
	// 				OR `schlusr_acclvl` = 2";
	// $rsreg = $dbConn->query($qry);
	// $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	// }



    $rsreg->free_result();
	$dbConn->close();
	echo json_encode($fetch);

?>