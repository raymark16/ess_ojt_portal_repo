<?php
	error_reporting(E_ALL);

	require('class/configuration/connection.php');
	
    if(isset($_GET['userid']))
    {
       	$userid = $_GET['userid'];      
        // GET STUDENT & CONTACT INFORMATION 

        $qry = "SELECT * FROM school_enrollment_pre_registration WHERE schlenrollprereg_id = $userid";
        $getprofile = mysqli_query($dbConn, $qry);
        $profile    = mysqli_fetch_array($getprofile);

		$get_acad_lvl = mysqli_query($dbConn, 
			"SELECT * FROM school_academic_level WHERE schlacadlvl_id = ". $profile['acadlvl_id']);
		$acad_lvl     = mysqli_fetch_array($get_acad_lvl);

		$get_acad_yrlvl = mysqli_query($dbConn, 
			"SELECT * FROM school_academic_year_level WHERE schlacadyrlvl_id = ". $profile['acadyrlvl_id']);
		$acad_yrlvl     = mysqli_fetch_array($get_acad_yrlvl);

		$get_acad_crse = mysqli_query($dbConn, 
			"SELECT * FROM school_academic_course WHERE schlacadcrse_id = ". $profile['acadcrse_id']);
		$acad_crse     = mysqli_fetch_array($get_acad_crse);

		
        // GET DOCUMENTS  
        $getDocuments = mysqli_query($dbConn, "SELECT * FROM oc_uploaded_documents WHERE registration_id = '$userid'");
		$documents    = mysqli_fetch_all($getDocuments, MYSQLI_ASSOC);

		$getReceipt = mysqli_query($dbConn, "SELECT * FROM oc_payments WHERE registration_id = '$userid'");
		$receipt    = mysqli_fetch_array($getReceipt);

		// GET PROVINCE 

		$get_pres_loc_prov = mysqli_query($dbConn, 
			"SELECT * FROM philippine_area_location_province WHERE philarealocprov_id = ". $profile['philarealocprov_present_id']);
		$pres_loc_prov  = mysqli_fetch_array($get_pres_loc_prov);

		$get_perma_loc_prov = mysqli_query($dbConn, 
			"SELECT * FROM philippine_area_location_province WHERE philarealocprov_id = ". $profile['philarealocprov_permanent_id']);
		$perma_loc_prov  = mysqli_fetch_array($get_perma_loc_prov);

		// GET MUNICIPALLITY

		$get_pres_loc_mun = mysqli_query($dbConn, 
			"SELECT * FROM philippine_area_location_municipality WHERE philarealocmun_id = ". $profile['philarealocmun_present_id']);
		$pres_loc_mun  = mysqli_fetch_array($get_pres_loc_mun);

		$get_perma_loc_mun = mysqli_query($dbConn, 
			"SELECT * FROM philippine_area_location_municipality WHERE philarealocmun_id = ". $profile['philarealocmun_permanent_id']);
		$perma_loc_mun  = mysqli_fetch_array($get_perma_loc_mun);

		// GET BARANGAY

		$get_pres_loc_brgy = mysqli_query($dbConn, 
			"SELECT * FROM philippine_area_location_barangay WHERE philarealocbrgy_id = ". $profile['philarealocbrgy_present_id']);
		$pres_loc_brgy  = mysqli_fetch_array($get_pres_loc_brgy);

		$get_perma_loc_brgy = mysqli_query($dbConn, 
			"SELECT * FROM philippine_area_location_barangay WHERE philarealocbrgy_id = ". $profile['philarealocbrgy_permanent_id']);
		$perma_loc_brgy  = mysqli_fetch_array($get_perma_loc_brgy);


	}



?>