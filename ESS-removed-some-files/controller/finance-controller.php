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


// FOR SHOWING STUDENTS IN FINANCE DASHBOARD

	$qryreg =	" 
				SELECT 	DATE_FORMAT(`reg`.`schlenrollprereg_regdate`, '%M %d, %Y') AS `REG_DATE`,
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
							`ocuser`.`verified` DESC
			";
							
	$rsreg = $dbConn->query($qryreg);
	$students = $rsreg->fetch_ALL(MYSQLI_ASSOC);





	
?>