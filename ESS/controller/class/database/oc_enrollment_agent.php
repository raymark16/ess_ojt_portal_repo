<?php 
	$qryagent = "SELECT CONCAT(enrollagent_lname , ', ' , enrollagent_fname , ' ' , enrollagent_mname) `AGENT_NAME`, 
					`enrollagent_id` `AGENT_ID`
					FROM oc_enrollment_agent
						WHERE enrollagent_isactive = 1 
							AND enrollagent_status = 1";
	$rsagent = $dbConn->query($qryagent);
	$fetchAllDataAgent = $rsagent->fetch_ALL(MYSQLI_ASSOC);
	$rsagent->close();
?>
