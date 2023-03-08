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

  	$qryuser = "SELECT `schlusr_lname` `NAME`,
				       `schlusr_id` `ESS_ID`
				FROM `school_users`
					WHERE `schlusr_status` = 1 
					AND `schlusr_isactive` = 1
					AND `schlusr_acclvl` = 1
					OR `schlusr_acclvl` = 2";
	$rsuser = $dbConn->query($qryuser);
	$fetchDatauser = $rsuser->fetch_ALL(MYSQLI_ASSOC);

	$qryreg = "	SELECT `reg`.`schlenrollprereg_regdate` `REG_DATE`,
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
						`reg`.`acadprd_id` = 2
					
				ORDER BY 	`reg`.`schlenrollprereg_verification` DESC, 
							`reg`.`schlenrollprereg_regdate` DESC";

	  					

	$rsreg = $dbConn->query($qryreg);
	$fetchDatareg = $rsreg->fetch_ALL(MYSQLI_ASSOC);


	$qryreg_ess = "SELECT `reg`.`schlenrollprereg_regdate` `REG_DATE`,
                UPPER(CONCAT(`reg`.`schlenrollprereg_lname`, ', ', `reg`.`schlenrollprereg_fname` , ' ' , `reg`.`schlenrollprereg_mname`)) `NAME`,
                UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
                UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
                UPPER(`crse`.`schlacadcrse_code`) `CRSE_NAME`, 
                `reg`.`schlusr_id` `USER_ID`,
                `reg`.`schlenrollprereg_verification` `VERIFY`, 
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
                    WHERE `reg`.`schlenrollprereg_verification` < 3  
                    AND `reg`.`ready_for_assesment` >= 0 
                    AND `reg`.`schlusr_id` = ". $_SESSION['USERID'] ." 
                    ORDER BY `reg`.`schlenrollprereg_verification` DESC, `reg`.`schlenrollprereg_regdate` DESC";

        $rsreg_ess = $dbConn->query($qryreg_ess);
        $fetchDatareg_ess = $rsreg_ess->fetch_ALL(MYSQLI_ASSOC);

	if(isset($_GET['prcss_id']))
    {
       	        $userid = $_GET['prcss_id'];

       	        $qry = "UPDATE school_enrollment_pre_registration 
       					SET schlenrollprereg_verification = 2
       					WHERE schlenrollprereg_id = $userid";

                mysqli_query($dbConn, $qry);  

                $qry = "UPDATE school_enrollment_pre_registration 
                        SET schlenrollprereg_status = 2
                        WHERE schlenrollprereg_id = $userid";

                mysqli_query($dbConn, $qry);  

                echo "<script type='text/javascript'>alert('Student is Processed Successfully')</script>";
                echo "<script type='text/javascript'>location.href='".$_SESSION['DASHBOARD']."'</script>";

	}

?>