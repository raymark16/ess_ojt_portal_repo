
<?php
	include('class/configuration/connection.php');
	// PROCESS STUDENT & ENROLL
        $dashboard = $_SESSION['DASHBOARD'];

	if(isset($_GET['prcss_id']))
    {
       	$userid = $_GET['prcss_id'];

       	$qry = "UPDATE school_enrollment_pre_registration 
       			SET schlenrollprereg_verification = 2
       			WHERE schlenrollprereg_id = $userid";

        mysqli_query($dbConn, $qry);  

        $qry = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_status = 2
                WHERE schlenrollprereg_id = $userid";

        mysqli_query($dbConn, $qry);  

        echo "<script type='text/javascript'>alert('Student is Processed Successfully')</script>";
        echo "<script type='text/javascript'>location.href='$dashboard'</script>";

    }

       // VERIFY STUDENT

    if (isset($_POST['submit']))
    {
      
        $id = $_GET['userid'];
        $esc_or_shs = isset($_POST['esc_or_shs']) ? $_POST['esc_or_shs'] : null;
     
        $qry = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_verification = 1, esc_or_shs = '". $esc_or_shs. "'
                WHERE schlenrollprereg_id = $id";

        mysqli_query($dbConn, $qry);
     
        $status = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_status = 1, esc_or_shs = '". $esc_or_shs. "'
                WHERE schlenrollprereg_id = $id";

        mysqli_query($dbConn, $status); 

        echo "<script type='text/javascript'>alert('Student is Verified Successfully')</script>";
        echo "<script type='text/javascript'>location.href='$dashboard'</script>";
   
    }


    
?>