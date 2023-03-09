<?php
    session_start();
	require('class/configuration/connection.php');
	include('class/configuration/server.php');

	if ($_GET['type'] == 'USERS') {
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
						`reg`.`acadprd_id` = 2
					
				ORDER BY 	`reg`.`schlenrollprereg_verification` DESC, 
							`reg`.`schlenrollprereg_regdate` DESC";
					
	$rsreg = $dbConn->query($qry);
	$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
}


$rsreg->free_result();
$dbConn->close();
echo json_encode($fetch);

?>