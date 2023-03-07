<?php

    error_reporting(E_ALL);
    require('finance-controller.php');

    // FOR VIEWING STUDENT INFORMATION IN FINANCE VERIFICATION FORM        

        if(isset($_SESSION['student_ID']))
        {
            $userid = $_SESSION['student_ID'];
            
             
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

            $getReceipt = mysqli_query($dbConn, "SELECT * FROM oc_enrollment_payments WHERE registration_id = '$userid'");
            $receipt    = mysqli_fetch_array($getReceipt);
        
       }
    
    
    
    if (isset($_POST['verify_payment']))
    {
              
        $qry = "UPDATE  `oc_enrollment_payments` 
                SET     `payment_status` = 1
                WHERE   `id` = " .  $_SESSION['payment_id'] ;

        mysqli_query($dbConn, $qry);     

        if(mysqli_affected_rows($dbConn) > 0)
        {
            echo "<script type='text/javascript'>alert('Payment is verified successfully.')</script>";
        }
        else
        {      
            echo "<script type='text/javascript'>alert('Verifying payment is not successful.')</script>";
        }
        echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
  
 
    }







?>