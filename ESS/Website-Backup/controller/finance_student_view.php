<?php

	error_reporting(E_ALL);

	require('class/configuration/connection.php');
    require('finance-controller.php');


	// FOR VIEWING STUDENT INFORMATION IN FINANCE VERIFICATION FORM        

	
        if(isset($_SESSION['student_ID']))
        {
            $userid = $_SESSION['student_ID'];

            echo $userid;
            echo '\n'.$_SESSION['STUDENT_TYPE'];

            if($_SESSION['STUDENT_TYPE'] != 'PAYMENT_ONLY')
            {   
                $qry = "SELECT * FROM school_enrollment_pre_registration WHERE schlenrollprereg_id =".$userid;
                $getprofile = mysqli_query($dbConn, $qry);
                $profile    = mysqli_fetch_array($getprofile);

                $_SESSION['STUDENT-FNAME'] = $profile['schlenrollprereg_fname']; 
                $_SESSION['STUDENT-LNAME'] = $profile['schlenrollprereg_lname'];
                $_SESSION['STUDENT-MNAME'] = $profile['schlenrollprereg_mname'];
                $_SESSION['STUDENT-SNAME'] = $profile['schlenrollprereg_suffix'];

                $_SESSION['STUDENT-NUM'] = $profile['schlenrollprereg_mobileno'];
                $_SESSION['STUDENT-TEL'] = $profile['schlenrollprereg_telno'];
                $_SESSION['STUDENT-EMAIL'] = $profile['schlenrollprereg_emailadd'];
        
                // GET DOCUMENTS  
                $getDocuments = mysqli_query($dbConn, "SELECT * FROM oc_uploaded_documents WHERE registration_id = '$userid'");
                $documents    = mysqli_fetch_all($getDocuments, MYSQLI_ASSOC);

                $getReceipt = mysqli_query($dbConn, "SELECT * FROM oc_payments WHERE registration_id = '$userid'");
                $receipt    = mysqli_fetch_array($getReceipt);

            }
            else
            {
                $qry = "SELECT * FROM oc_user_accounts WHERE id =".$userid;
                $getprofile = mysqli_query($dbConn, $qry);
                $profile = mysqli_fetch_array($getprofile);
                
                $_SESSION['STUDENT-FNAME'] = $profile['first_name']; 
                $_SESSION['STUDENT-LNAME'] = $profile['last_name'];
                $_SESSION['STUDENT-MNAME'] = $profile['middle_name'];
                $_SESSION['STUDENT-SNAME'] = " ";

                $_SESSION['STUDENT-NUM'] = ' ';
                $_SESSION['STUDENT-TEL'] = ' ';
                $_SESSION['STUDENT-EMAIL'] = $profile['emailaddress'];

                // GET DOCUMENTS

                $getReceipt = mysqli_query($dbConn, "SELECT * FROM oc_payments WHERE account_id = '$userid'");
                $receipt    = mysqli_fetch_array($getReceipt);  

                $getDocuments = mysqli_query($dbConn, "SELECT * FROM oc_uploaded_documents WHERE document_id =". $receipt['receipt_id']);
                $documents    = mysqli_fetch_all($getDocuments, MYSQLI_ASSOC);
            }
	   }
    
	
	
	if (isset($_POST['submit']))
    {
      
        $id = $_SESSION['student_ID'];
     
        $qry = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_verification = 3
                WHERE schlenrollprereg_id = $id";

        mysqli_query($dbConn, $qry);

        $status = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_status = 4
                WHERE `schlenrollprereg_id` = $id";

        mysqli_query($dbConn, $status);

        echo "<script type='text/javascript'>alert('Student is Verified Successfully')</script>";
        echo "<script type='text/javascript'>location.href='finance-enrollment-registration-process-form.php'</script>";
 
    }







?>