<?php 
	$qryacadlvl = "SELECT schlacadlvl_id, 
						  schlacadlvl_code, 
						  schlacadlvl_name, 
						  schlacadlvl_desc, 
						  schlacadlvl_status, 
						  schlacadlvl_isactive 
						From school_academic_level
							WHERE schlacadlvl_status = 1 AND schlacadlvl_isactive = 1";
	$rsacadlvl = $dbConn->query($qryacadlvl);
	$fetchAllDataAcademicLevel = $rsacadlvl->fetch_ALL(MYSQLI_ASSOC);
	$rsacadlvl->close();
?>
