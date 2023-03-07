

<?php
	require('class/configuration/connection.php');
	include('class/configuration/server.php');
    $GLOBALS['registration_id'];
    if ($_GET['type'] == 'STUD_DETAILS'){
       // $registration_id = 0;
        $GLOBALS['registration_id'] = $_GET['reg_id'];
        $ei = $GLOBALS['registration_id'];
		$qry = "SELECT *
		FROM `school_enrollment_pre_registration` 
		WHERE `school_enrollment_pre_registration`.`schlenrollprereg_id` = ' $ei '";
		
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_array(MYSQLI_ASSOC);
	}
    if ($_GET['type'] == 'INFO'){
        $ii = $GLOBALS['registration_id'];
		$qry = "SELECT `schlenrollprereg_lname`,
		`schlenrollprereg_fname`,
		`schlenrollprereg_mname`,
		`schlenrollprereg_suffix`,
		`schlacadyrlvl_name`,
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
		WHERE `school_enrollment_pre_registration`.`schlenrollprereg_id` = '$ii'";
		
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_array(MYSQLI_ASSOC);
	}


    $rsreg->free_result();
	$dbConn->close();
	echo json_encode($fetch);

?>