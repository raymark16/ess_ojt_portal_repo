<?php 
	require_once('../configuration/connection.php');
	$userid = intval($_GET['userid']);
	echo $userid;
if ($userid != ""){
	$qryreg = "SELECT `reg`.`schlenrollprereg_regdate` `REG_DATE`,
					  UPPER(CONCAT(`reg`.`schlenrollprereg_lname`, ', ', `reg`.`schlenrollprereg_fname` , ' ' , `reg`.`schlenrollprereg_mname`)) `NAME`,
					  UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
					  UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
					  UPPER(`crse`.`schlacadcrse_name`) `CRSE_NAME`, 
					  `reg`.`schlusr_id` `USER_ID`,
					  `reg`.`schlenrollprereg_id` `EDIT`,
					  `reg`.`schlenrollprereg_id` `PROCESS`
					FROM `school_enrollment_pre_registration` `reg`
						LEFT JOIN `school_academic_level` `lvl`
							ON `reg`.`acadlvl_id`=`lvl`.`schlacadlvl_id`
						LEFT JOIN `school_academic_year_level` `yrlvl`
							ON `reg`.`acadyrlvl_id`=`yrlvl`.`schlacadyrlvl_id`
						LEFT JOIN `school_academic_course` `crse`
							ON `reg`.`acadcrse_id`=`crse`.`schlacadcrse_id`
						LEFT JOIN `school_users` `usr`
							ON `reg`.`schlusr_id`=`usr`.`schlusr_id`
							WHERE `reg`.`schlusr_id` = ".$userid.; 
	/*$qryuser = "SELECT CONCAT(`schlusr_lname`,', ', `schlusr_fname`) `NAME`,
				       `schlusr_id` `USER_ID`
				FROM `school_users`
					WHERE `schlusr_status` = 1 
					AND `schlusr_isactive` = 1";
	$rsuser = $dbConn->query($qryuser);
	$fetchDatauser = $rsuser->fetch_ALL(MYSQLI_ASSOC);*/
	
	$rsreg = $dbConn->query($qryreg);
	$fetchDatareg = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	
	
	$createTable  = "<table class='table caption-top table-hover'>";
	$createTable .= "<thead class='table-dark'>";
	$createTable .= "tr>";
	$createTable .= "<th scope='col'>Timestamp</th>";
	$createTable .= "<th scope='col'>Student Name</th>";
	$createTable .= "<th scope='col'>Level</th>";
	$createTable .= "<th scope='col'>Grade Level</th>";
	$createTable .= "<th scope='col'>Course Strand</th>";
	$createTable .= "<th scope='col'>Assigned to</th>";
	$createTable .= "<th scope='col'>Actions</th>";
	$createTable .= "</tr>";
	$createTable .= "</thead>";
	$createTable .= "<tbody>";
	
	foreach($fetchDatareg as $regitem)
	{
		$createTable .= "<tr id='prereg-list'>";
		$createTable .= "<td>".$regitem['REG_DATE']."</td>";
		$createTable .= "<td>".$regitem['NAME']."</td>";
		$createTable .= "<td>".$regitem['LVL_NAME']."</td>";
		$createTable .= "<td>".$regitem['YRLVL_NAME']."</td>";
		$createTable .= "<td>".$regitem['CRSE_NAME']."</td>";
		$createTable .= "<td>";
		$createTable .= "<div class='dropdown'>";
		$createTable .= "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>ESS</button>";
		$createTable .= "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
		   //foreach($fetchDatauser as $useritem)
		   //{
			//$createTable .= "<li><a class='dropdown-item' href='#'>".$useritem['NAME']."</a></li>";
		   //}
		$createTable .= "<li><a class='dropdown-item' href='#'>TESTING</a></li>";
		$createTable .= "</ul>";
		$createTable .= "</div>";
		$createTable .= "</td>";
		$createTable .= "<td>";
		$createTable .= "<div class='btn-group' role='group' aria-label='Basic example'>";
		$createTable .= "<button type='button' class='btn btn-primary'>EDIT</button>";
		$createTable .= "<input type='hidden' id='prereg_id' name='prereg_id' value='".$regitem['EDIT']."'>";
		$createTable .= "</button>";
		$createTable .= "<button type='button' class='btn btn-danger'>Process</button>";
		$createTable .= "<input type='hidden' id='prereg_id' name='prereg_id' value='".$regitem['PROCESS']."'>";
		$createTable .= "</div>";
		$createTable .= "</td>";
		$createTable .= "</tr>";
	}
	$createTable .= "</tbody>";
	$createTable .= "</table>";
	echo $createTable;

	$rs->close();

	$dbConn->close();
} else {
		$createTable  = "<tr id='prereg-list'>";
		$createTable .= "<td>TESING</td>";
		$createTable .= "<td>TESING</td>";
		$createTable .= "<td>TESING</td>";
		$createTable .= "<td>TESING</td>";
		$createTable .= "<td>TESING</td>";
		$createTable .= "<td>";
		$createTable .= "<div class='dropdown'>";
		$createTable .= "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>ESS</button>"
		$createTable .= "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
		   //foreach($fetchDatauser as $useritem)
		   //{
			//$createTable .= "<li><a class='dropdown-item' href='#'>".$useritem['NAME']."</a></li>";
		   //}
		$createTable .= "<li><a class='dropdown-item' href='#'>TESTING</a></li>";
		$createTable .= "</ul>";
		$createTable .= "</div>";
		$createTable .= "</td>";
		$createTable .= "<td>";
		$createTable .= "<div class='btn-group' role='group' aria-label='Basic example'>";
		$createTable .= "<button type='button' class='btn btn-primary'>EDIT</button>";
		$createTable .= "<input type='hidden' id='prereg_id' name='prereg_id' value='TESING'>";
		$createTable .= "</button>";
		$createTable .= "<button type='button' class='btn btn-danger'>Process</button>";
		$createTable .= "<input type='hidden' id='prereg_id' name='prereg_id' value='TESING'>";
		$createTable .= "</div>";
		$createTable .= "</td>";
		$createTable .= "</tr>";
		
		echo $createTable;
}
?>
