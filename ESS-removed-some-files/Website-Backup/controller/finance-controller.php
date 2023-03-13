<?php
	require('class/configuration/connection.php');

	if(session_status() === PHP_SESSION_NONE)
	{
    	session_start();
	}

	if (isset($_GET['logout'])) 
	{
		session_destroy();
		unset($_SESSION['username']);
		unset($_SESSION['first_name']);
		unset($_SESSION['last_name']);
		unset($_SESSION['position']);
		header('location: ../login.php');
		exit();
  	}


// FOR SHOWING STUDENTS IN FINANCE DASHBOARD

	$qryreg = 	"	SELECT `reg`.`schlenrollprereg_regdate` `REG_DATE`,
					 	UPPER(CONCAT(`reg`.`schlenrollprereg_lname`, ', ', 
					  		`reg`.`schlenrollprereg_fname` , ' ' , `reg`.`schlenrollprereg_mname`)) `NAME`,
					  	UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
					  	UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
					  	UPPER(`crse`.`schlacadcrse_code`) `CRSE_NAME`, 
					  	`reg`.`schlusr_id` `USER_ID`,
					  	`reg`.`schlenrollprereg_verification` `VERIFY`, 
					  	`reg`.`schlenrollprereg_id` `VIEW`,
						`reg`.`schlenrollprereg_id` `PROCESS`
					FROM `school_enrollment_pre_registration` `reg`
						LEFT JOIN `school_academic_level` `lvl`
							ON 	`reg`.`acadlvl_id`=`lvl`.`schlacadlvl_id`
						LEFT JOIN `school_academic_year_level` `yrlvl`
							ON 	`reg`.`acadyrlvl_id`=`yrlvl`.`schlacadyrlvl_id`
						LEFT JOIN `school_academic_course` `crse`
							ON 	`reg`.`acadcrse_id`=`crse`.`schlacadcrse_id`
						LEFT JOIN `school_users` `usr`
							ON 	`reg`.`schlusr_id`=`usr`.`schlusr_id` 
						WHERE 	`reg`.`schlenrollprereg_verification` >= 2
						ORDER BY `reg`.`schlenrollprereg_verification` DESC, `reg`.`schlenrollprereg_regdate` DESC"; 
							
	$rsreg = $dbConn->query($qryreg);
	$fetchDatareg = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	
	// FOR ENROLLING 

	
	if(isset($_GET['prcss_id']))
    {
       	$userid = $_GET['prcss_id'];

       	$qry = "UPDATE school_enrollment_pre_registration 
       			SET schlenrollprereg_verification = 4
       			WHERE schlenrollprereg_id = $userid";

        mysqli_query($dbConn, $qry);  

        echo "<script type='text/javascript'>alert('Student is Enrolled Successfully')</script>";
        echo "<script type='text/javascript'>location.href='../finance-enrollment-registration-process-form.php'</script>";

    }
	
?>