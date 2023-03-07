<?php 
require_once('../configuration/connection.php');

if(isset($_POST['requirementidhidden']))
{
   $lastname = strval($_POST['lastname']);
   $firstname=strval($_POST['firstname']);
   $middlename=strval($_POST['middlename']);
   $suffix=strval($_POST['suffix']);
   $gender=strval($_POST['gender']);
   $birthdate=strval($_POST['birthdate']);
   $age=intval($_POST['age']);
   $birthplace=strval($_POST['birthplace']);
   $nationality=strval($_POST['nationality']);
   $religion=strval($_POST['religion']);
   $mothertongue=strval($_POST['mothertongue']);
   $civilstatus=strval($_POST['civilstatus']);
   $numberofsiblings=intval($_POST['numberofsiblings']);
   $mobilenumber=intval($_POST['mobilenumber']);
   $telephone=intval($_POST['telephone']);
   $emailaddress=strval($_POST['emailaddress']);
   $presentstreetaddress=strval($_POST['presentstreetaddress']);
   $permanentstreetaddress=strval($_POST['permanentstreetaddress']);
   $presentzipcode=intval($_POST['presentzipcode']);
   $permanentzipcode=intval($_POST['permanentzipcode']);
   $presentprovinceid=intval($_POST['presentprovinceid']);
   $presentmunicipalityid=intval($_POST['presentmunicipalityid']);
   $presentbarangayid=intval($_POST['presentbarangayid']);
   $permanentprovinceid=intval($_POST['permanentprovinceid']);
   $permanentmunicipalityid=intval($_POST['permanentmunicipalityid']);
   $permanentbarangayid=intval($_POST['permanentbarangayid']);
   $acadlvlid=intval($_POST['acadlvlid']);
   $acadyrlvlid=intval($_POST['acadyrlvlid']);
   $acadcrseid=intval($_POST['acadcrseid']);
   $agentid=intval($_POST['agentid']);
   $regdate= strval($_POST['regdate']);
   $requirementidhidden= strval($_POST['requirementidhidden']);
   $requirementnamehidden= strval($_POST['requirementnamehidden']);
   $target_dir = strval($_POST['target_dir']);
   
	$qry = "INSERT INTO `school_enrollment_pre_registration`(`schlenrollprereg_lname`,
				   `schlenrollprereg_fname`,
				   `schlenrollprereg_mname`,
				   `schlenrollprereg_suffix`,
				   `schlenrollprereg_gender`,
				   `schlenrollprereg_bdate`,
				   `schlenrollprereg_age`,
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
				   `philarealocprov_present_id`,
				   `philarealocmun_present_id`,
				   `philarealocbrgy_present_id`,
				   `philarealocprov_permanent_id`,
				   `philarealocmun_permanent_id`,
				   `philarealocbrgy_permanent_id`,
				   `schlenrollprereg_regdate`,
				   `schlenrollprereg_status`,
				   `schlenrollprereg_isactive`,
				   `acadlvl_id`,
				   `acadyrlvl_id`,
				   `acadcrse_id`,
				   `enrollagent_id`,
				   `enrollreq_id`,
				   `schlenrollregreq_file_path`,
				   `schlenrollregreq_filename`) VALUES('".$lastname."',
					   '".$firstname."',
					   '".$middlename."',
					   '".$suffix."',
						'".$gender."',
						'".$birthdate."',
						".$age.",
						'".$birthplace."',
						'".$nationality."',
						'".$religion."',
						'".$mothertongue."',
						'".$civilstatus."',
						".$numberofsiblings.",
						".$mobilenumber.",
						".$telephone.",
						'".$emailaddress."',
						'".$presentstreetaddress."',
						'".$permanentstreetaddress."',
						".$presentzipcode.",
						".$permanentzipcode.",
						".$presentprovinceid.",
						".$presentmunicipalityid.",
						".$presentbarangayid.",
						".$permanentprovinceid.",
						".$permanentmunicipalityid.",
						".$permanentbarangayid.",
						'".$regdate."',
						1,
						1,
						".$acadlvlid.",
						".$acadyrlvlid.",
						".$acadcrseid.",
						".$agentid.",
						'".$requirementidhidden."',
						'".$target_dir."',
						'".$requirementnamehidden."')";
	$last_id = -1;
	if(mysqli_query($dbConn, $qry))
	{
		$last_id = mysqli_insert_id($dbConn);
	} else {
		$last_id = -1;
	}
	//$_SESSION['INSERTEDID'] = $last_id;
	echo $last_id;
	mysqli_close($dbConn);
	
}
?>
