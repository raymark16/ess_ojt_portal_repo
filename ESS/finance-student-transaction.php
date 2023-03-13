<?php
    
    session_start();
    include('controller/finance-controller.php');

	$qry = 	"	
                SELECT * 
                FROM `oc_enrollment_payments` 
                WHERE `registration_id` = " . $_SESSION['student_ID'] . "
                ORDER BY `payment_submitted_date` ";

    $rsreg = $dbConn->query($qry);
    $get_transaction = $rsreg->fetch_ALL(MYSQLI_ASSOC); 


    $get_registration = mysqli_query($dbConn, "SELECT * FROM `school_enrollment_pre_registration` WHERE `acadprd_id` = 2 AND `schlenrollprereg_id` = " . $_SESSION['student_ID']  );
    $registration     = $get_registration->fetch_all(MYSQLI_ASSOC);

    $latest_registration = $registration[0];


    // -- -- -- --  FOR PROCESSING STUDENT 


    if(isset($_GET['process_id']))
    {
        $userid = $_GET['process_id'];

        $qry = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_verification = 3
                WHERE schlenrollprereg_id = $userid";

        mysqli_query($dbConn, $qry);

        $status = " UPDATE school_enrollment_pre_registration 
                        SET schlenrollprereg_status = 4
                        WHERE `schlenrollprereg_id` = $userid";

        mysqli_query($dbConn, $status);


        if(mysqli_affected_rows($dbConn) > 0)
        {
            echo "<script type='text/javascript'>alert('Student is Processed Successfully')</script>";
            echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
        }
        else
        {      
            echo "<script type='text/javascript'>alert('Processing Student is not Successful')</script>";
            echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
        } 
    }

    //  -- -- -- -- FOR ENROLLING STUDENT

    if(isset($_GET['enroll_id']))
    {
        $userid = $_GET['enroll_id'];

        $qry = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_verification = 4
                WHERE schlenrollprereg_id = $userid";

        mysqli_query($dbConn, $qry);

        if(mysqli_affected_rows($dbConn) > 0)
        {
            echo "<script type='text/javascript'>alert('Student is Enrolled Successfully')</script>";
            echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
        }
        else
        {      
            echo "<script type='text/javascript'>alert('Enrolling Student is not Successful')</script>";
            echo "<script type='text/javascript'>location.href='finance-student-transaction.php'</script>";
        }  
    }


    // FOR VIEWING PAYMENT DETAILS 


    if(isset($_GET['userid']))
    {   
        $_SESSION['payment_id'] = $_GET['userid'];
        echo "<script type='text/javascript'>location.href='finance-verification-form.php'</script>";
    }



    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="tool/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="image/fcpc_logo_2.ico">
    <title>FINANCE DASHBOARD</title>

</head>
<body style="border:1px solid background: 
                                  rgba(191,217,250,0.8); 
                                  background-image: url('image/FCPC LOGO.png');
                                  background-size: 70%;
                                  background-repeat: no-repeat;
                                  background-position: center;
                                  padding-bottom: 0;
                                  padding-top: 0;
                                  background-op;">
    <div class="container">
        <br>
        <h1 align="center" style="font-size: 50px; font-family: 'Times New Roman', Times, serif;color: blue;">FIRST CITY
            PROVIDENTIAL COLLEGE</h1>
        <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> STUDENT PAYMENT HISTORY </div>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                
            </div>
            <div class="col-md-2">
                <!-- 
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Display Data</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">25</a></li>
                        <li><a class="dropdown-item" href="#">50</a></li>
                        <li><a class="dropdown-item" href="#">100</a></li>
                    </ul>
                </div>
            -->
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <form class="d-flex">
                    <a class="dropdown-item" disabled></a>
                    <a href="controller/finance-controller.php?logout='1'"><button type='button'
                            class='btn btn-danger'>LOGOUT </button></a>
                </form>
            </div>

        </div>
        <br>
        <br>
    </div>
    <!-- Sign in  Form -->



        <div class="container" id="table-list" class="table-responsive">
        <div id="prereg-data"></div>
        <?php

        $createTable  = "<table id='regtable' class='table table-hover table-responsive table-bordered'style='text-align:center;'>";
        $createTable .= "<thead class='table-primary'>";
        $createTable .= "<tr>";
        $createTable .= "<th scope='col'>#</th>";
        $createTable .= "<th scope='col'>Date</th>";
        $createTable .= "<th scope='col'>Transaction</th>";
        $createTable .= "<th scope='col'>Bank name</th>";
        $createTable .= "<th scope='col'>Amount</th>";
        $createTable .= "<th scope='col'>Transaction Date</th>";
        $createTable .= "<th scope='col'>Transaction Number</th>";
        $createTable .= "<th scope='col'>Payment Status</th>";
        $createTable .= "<th scope='col' colspan=2 >Actions</th>";

        //$createTable .= "<th scope='col'>ID</th>";
        $createTable .= "</tr>";
        $createTable .= "</thead>";
        $createTable .= "<tbody>";
        $createTable .= "<div></div>";
        $count = 1;

        foreach($get_transaction as $transaction)
        {   
            $date = $transaction['payment_submitted_date'];

            $createTable .= "<tr>";
            $createTable .= "<td class='table-primary'>".$count++."</td>";
            $createTable .= "<td                      >". date("M d, Y", strtotime($date)) ."</td>";
            $createTable .= "<td                      >".$transaction['transaction_type']."</td>";
            $createTable .= "<td                      >".$transaction['bank']."</td>";
            $createTable .= "<td                      >".$transaction['amount']."</td>";
            $createTable .= "<td                      >".$transaction['transaction_date']."</td>";
            $createTable .= "<td                      >".$transaction['reference_number']."</td>";

            // -- -- -- FOR STATUS 

            $createTable .= "<td>";

            if($transaction['payment_status'] == 0)
            {
                $createTable .=  "<label type='label' class='text-danger' disabled> Not Verified</label>";
            }
            else
            {
                $createTable .=  "<label type='label' class='text-success' disabled> Payment Verified</label>";

            }
            $createTable .= "</td>";

            // -- -- -- FOR ACTIONS

            $ID = $transaction['id'];

            // $createTable .= "<td>
            //                     <a href='finance-student-transaction.php?payment_id=$ID'>
            //                         <label type='label' class='btn btn-primary'>VIEW PAYMENT DETAILS</label></a>
            //                     </a>
            //                 </td>";

            $createTable .= "<td><a href='finance-student-transaction.php?userid=".$ID."' ><label type='label' class='btn btn-primary' onSubmit='window.location.reload()''>VIEW PAYMENT FORM</label></a></td>";
              

            $userid = $latest_registration['schlenrollprereg_id'];

            if($transaction['payment_remarks'] == 'tuition')
            {
                $createTable .= "<td>";

                if($latest_registration['schlenrollprereg_verification'] == 2)
                {
                    $createTable .= "<a href='finance-student-transaction.php?process_id=$userid'>
                    <label type='label' class='btn btn-secondary' onSubmit='window.location.reload()' style='font-size: 13px;'>PROCESS STUDENT </label></a>";            
                }
                if($latest_registration['schlenrollprereg_verification'] == 3)
                {
                    $createTable .= "<a href='finance-student-transaction.php?enroll_id=$userid'>
                    <label type='label' class='btn btn-warning' onSubmit='window.location.reload()' style='font-size: 13px;'>SEND COE / OR </label></a>";             

                }
                if($latest_registration['schlenrollprereg_verification'] == 4)
                {
                    $createTable .=  "<label type='label' class='text-success' disabled> STUDENT ENROLLED</label>";
                }

                $createTable .= "</td>";
            }

            if($transaction['payment_remarks'] == 'installment')
            {
                $createTable .=  "<td><label type='label' class='btn btn-outline-primary' disabled> Other Payments</label></td>";
            }


            

            $createTable .= "</tr>";

        }

        $createTable .= "</tbody>";
        $createTable .= "</table>";
        
        echo $createTable;
        
        $rsreg->close();
        //$dbConn->close();

        echo"<a href='finance-enrollment-registration-process-form.php' style = 'font-size: 40;'
                <label type='label'class='btn btn-secondary' onSubmit='window.location.reload()''>
                    Go Back
                </label>
            </a>"
    ?>
    <br>
    <br>
    </div>
       
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>