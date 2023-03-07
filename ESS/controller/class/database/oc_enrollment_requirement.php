<?php 
require_once('../configuration/connection.php');
if(isset($_POST['schlacadyrlvl_id']) && is_numeric($_POST['schlacadyrlvl_id']) 
	&& isset($_POST['schlacadlvl_id']) && is_numeric($_POST['schlacadlvl_id']))
{	
	$cntid = 0;
	$cnt = 0;
	$docid = "";
	$requirementid = '';
	$requirementname = '';
	$acadlvl_id = intval($_POST['schlacadlvl_id']);
	$acadyrlvl_id = intval($_POST['schlacadyrlvl_id']);
	$qry = "SELECT * FROM `oc_enrollment_requirement` 
				WHERE `enrollreq_status` = 1
					AND `enrollreq_isactive` = 1 
					AND`schlacadlvl_id` = ".$acadlvl_id." AND `schlacadyrlvl_id` = ".$acadyrlvl_id;

	$rs = $dbConn->query($qry);
	
	$fetchAllDataEnrollmentRequirements = $rs->fetch_ALL(MYSQLI_ASSOC);
	$createEnrollmentRequirements  = "<div align='center' style='background-color: lightblue;'><h2>REQUIREMENTS</h2></div>";
	$createEnrollmentRequirements .= "<div class='row'>";
	$createEnrollmentRequirements .= "<div class='col-md-12'>";
	$createEnrollmentRequirements .= "<p style='margin: 0; padding: 0; font-size: 18; font-style: italic; color: red;'>";
	$createEnrollmentRequirements .= "note: Please provide the required documents with (*) below.";
	$createEnrollmentRequirements .= "</p><br>";
	$createEnrollmentRequirements .= "</div>";
	$createEnrollmentRequirements .= "</div>";
	$createEnrollmentRequirements .= "<div class='col-md-12'>";
	
	foreach($fetchAllDataEnrollmentRequirements as $enrollmentrequirements)
	{
		$cnt++;
		$cntid++;
		$pid = "p" . $cntid;
		$docid = "doc" . $cntid;
		if ($cnt == 1)
		{
			$createEnrollmentRequirements .= "<div class='row'>";
			//$createEnrollmentRequirements .= "<div class='col-md-4'></div>";
			$createEnrollmentRequirements .= "<div class='col-md-6'>";
			if ($enrollmentrequirements['enrollreq_isrequired'] == 0){
				$createEnrollmentRequirements .= "<p id='".$pid."' ".($enrollmentrequirements['enrollreq_name'] == '' && $enrollmentrequirements['enrollreq_desc'] == '' ? 'hidden' : '').">".$enrollmentrequirements['enrollreq_name']."</p>";
				$createEnrollmentRequirements .= "<input type='file' id='". $docid ."' name='".$enrollmentrequirements['enrollreq_id']."' ".($enrollmentrequirements['enrollreq_name'] == '' && $enrollmentrequirements['enrollreq_desc'] == '' ? 'hidden' : '').">";
			//	$createEnrollmentRequirements .= "<div id='preview'><img src='filed.png' /></div>";
			} else {
				$createEnrollmentRequirements .= "<p id='".$pid."' ".($enrollmentrequirements['enrollreq_name'] == '' && $enrollmentrequirements['enrollreq_desc'] == '' ? 'hidden' : '').">".$enrollmentrequirements['enrollreq_name']." * </p>";
				$createEnrollmentRequirements .= "<input type='file' id='" . $docid . "' name='".$enrollmentrequirements['enrollreq_id']."' ".($enrollmentrequirements['enrollreq_name'] == '' && $enrollmentrequirements['enrollreq_desc'] == '' ? 'hidden' : '').">";
			//	$createEnrollmentRequirements .= "<div id='preview'><img src='filed.png' /></div>";
			}
			$requirementid = $requirementid . '[|]' . $enrollmentrequirements['enrollreq_id'];
			$requirementname = $requirementname . '[|]' . $enrollmentrequirements['enrollreq_name'];
			//$createEnrollmentRequirements .= "<img src='image/Loader.gif' id='loader' />";
			$createEnrollmentRequirements .= "</div>";
			//$createEnrollmentRequirements .= "<div class='col-md-4'></div>";
			
		} else if ($cnt == 2){
			$createEnrollmentRequirements .= "<div class='col-md-6'>";
			if ($enrollmentrequirements['enrollreq_isrequired'] == 0){
				$createEnrollmentRequirements .= "<p id='".$pid."' ".($enrollmentrequirements['enrollreq_name'] == '' && $enrollmentrequirements['enrollreq_desc'] == '' ? 'hidden' : '').">".$enrollmentrequirements['enrollreq_name']."</p>";
				$createEnrollmentRequirements .= "<input type='file' id='" . $docid . "' name='".$enrollmentrequirements['enrollreq_id']."' ".($enrollmentrequirements['enrollreq_name'] == '' && $enrollmentrequirements['enrollreq_desc'] == '' ? 'hidden' : '').">";
			//	$createEnrollmentRequirements .= "<div id='preview'><img src='filed.png' /></div>";
			} else {
				$createEnrollmentRequirements .= "<p id='".$pid."' ".($enrollmentrequirements['enrollreq_name'] == '' && $enrollmentrequirements['enrollreq_desc'] == '' ? 'hidden' : '').">".$enrollmentrequirements['enrollreq_name']." * </p>";
				$createEnrollmentRequirements .= "<input  type='file' id='" . $docid . "' name='".$enrollmentrequirements['enrollreq_id']."' ".($enrollmentrequirements['enrollreq_name'] == '' && $enrollmentrequirements['enrollreq_desc'] == '' ? 'hidden' : '').">";
			//	$createEnrollmentRequirements .= "<div id='preview'><img src='filed.png' /></div>";
			}
			$requirementid = $requirementid . '[|]' . $enrollmentrequirements['enrollreq_id'];
			$requirementname = $requirementname . '[|]' . $enrollmentrequirements['enrollreq_name'];
			//$createEnrollmentRequirements .= "<img src='image/Loader.gif' id='loader' />";
			$createEnrollmentRequirements .= "</div>";
			$createEnrollmentRequirements .= "</div>";
			$cnt = 0;
		}
	}
	$createEnrollmentRequirements .= "<input type='hidden' id='requirementidhidden' name='requirementidhidden' value='".substr($requirementid,3)."'>";
	$createEnrollmentRequirements .= "<input type='hidden' id='requirementnamehidden' name='requirementnamehidden' value='".substr($requirementname,3)."'>";
	$createEnrollmentRequirements .= "</div>";
	//$createEnrollmentRequirements .= "<div id='err'></div>";
	$createEnrollmentRequirements .= "<br>";
	echo $createEnrollmentRequirements;
	$rs->close();
	$dbConn->close();
} 
?>