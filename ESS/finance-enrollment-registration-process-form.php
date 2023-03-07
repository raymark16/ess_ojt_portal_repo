<?php
    require('controller/class/configuration/connection-config.php');
    include('controller/finance-controller.php');

    if (isset($_GET['logout'])) 
    {   
        session_destroy();
    
        unset($_SESSION['USERNAME']);
        unset($_SESSION['FIRST_NAME']);
        unset($_SESSION['LAST_NAME']);
        unset($_SESSION['POSITION']);
        unset($_SESSION['USERID']);
        
        header('location: login.php');
        exit();
    }


    unset($_SESSION['student_ID']);
    unset($_SESSION['STUDENT_TYPE']);

    if(isset($_GET['userid']) || isset($_GET['stud_type']))
    {   
        $_SESSION['student_ID'] = $_GET['userid'];
        header('location: finance-student-transaction.php');    
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

    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

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
        <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> FINANCE
            MANAGEMENT DASHBOARD </div>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <form class="d-flex">
                    <a class="dropdown-item" disabled></a>
                    <a href="finance-enrollment-registration-process-form?logout='1'"><button type='button'
                            class='btn btn-danger'>LOGOUT </button></a>
                </form>
            </div>

        </div>
        <br>
        <br>
    </div>
    <!-- Sign in  Form -->
        <div class="container " id="table-list" class="table-responsive">
        <div id="prereg-data"></div>


        <?php

        $createTable  = "<table id='regtable' class='table table-hover table-responsive ' style='font-size : 14px;'>";
        $createTable .= "<thead class='table-primary'>";
        $createTable .= "<tr>";
        $createTable .= "<th scope='col' style='text-align:center;'>#</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Timestamp</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Student Name</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Student Type</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Level</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Grade Level</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Course Strand</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Status</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Payment Verified</th>";
        $createTable .= "<th scope='col' style='text-align:center;' colspan=2 >Actions</th>";

        //$createTable .= "<th scope='col'>ID</th>";
        $createTable .= "</tr>";
        $createTable .= "</thead>";
        $createTable .= "<tbody>";
        $count = 1;
        foreach($students as $student)
        {   

            $getReceipt = mysqli_query($dbConn, "SELECT * FROM oc_enrollment_payments WHERE registration_id = ".$student['REG_ID']  );
            $ID     = $student['REG_ID'];
            $TYPE   = $student['STUDENT_TYPE'];
            $STATUS = $student['REG_STATUS'];

            $receipt    = $getReceipt->fetch_ALL(MYSQLI_ASSOC);

            $createTable .= "<tr>";
            $createTable .= "<td style='text-align:center;' class='table-primary'>".$count++."</td>";
            $createTable .= "<td style='text-align:center;' >".$student['REG_DATE']."</td>";
            $createTable .= "<td style='text-align:center;' >".$student['NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".str_replace("_", " ", $student['STUDENT_TYPE'])."</td>";
            $createTable .= "<td style='text-align:center;' >".$student['LVL_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$student['YRLVL_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$student['CRSE_NAME']."</td>";


            $createTable .= "<td style='text-align:center;'>";

            if($STATUS == 2)
            {
                $createTable .= "<label type='label' class='btn btn-outline-secondary' disabled style='font-size: 13px;'>ESS VERIFIED</label>";
            }
            if($STATUS == 3)
            {
                $createTable .= "<label type='label' class='btn btn-warning' disabled style='font-size: 13px;'>STUDENT PROCESSED</label>";
            }
            if($STATUS == 4 )
            {
                $createTable .= "<label type='label' class='btn btn-success' disabled style='font-size: 13px;'>STUDENT ENROLLED</label>";
            }

            $createTable .= "</td>";

            // -- -- -- FOR  NUMBER VERIFIED STATUS 


            $createTable .= "<td style='text-align:center;' >";


                $qry   = "SELECT COUNT(*) FROM `oc_enrollment_payments` WHERE `registration_id` = " . $ID . " AND `payment_status` = 1";
                $rsreg = $dbConn->query($qry);
                $verified_payments = $rsreg->fetch_array(MYSQLI_ASSOC);

                $verified_payments = $verified_payments['COUNT(*)'];


                $qry   = "SELECT COUNT(*) FROM `oc_enrollment_payments` WHERE `registration_id` = " . $ID;
                $rsreg = $dbConn->query($qry);
                $number_of_payments = $rsreg->fetch_array(MYSQLI_ASSOC);

                $number_of_payments = $number_of_payments['COUNT(*)'];

                if($number_of_payments == 0)
                {

                }

                elseif( $verified_payments == $number_of_payments)
                {
                    $createTable .=  "<label type='label' class='btn btn-outline-success' disabled style='font-size: 13px;'> All payments are verified </label>";
                }
                else
                {
                    $createTable .=  "<label type='label' class='btn btn-outline-danger' disabled style='font-size: 13px;' >" . $verified_payments . " payment verified out of " . $number_of_payments .  "</label>";
                }


            $createTable .= "</td>";


            // -- --- --- FOR PAYMENTS 

            $createTable .= "<td style='text-align:center;' >";

            if($receipt !=null)
            {
                $createTable .= "<a href='finance-enrollment-registration-process-form.php?userid=$ID'>
                <label type='label' class='btn btn-primary' onSubmit='window.location.reload()' style='font-size: 13px;'>PAYMENT TREND</label></a>";
            }
            else
            {
                $createTable .= "<label type='label' class='btn btn-secondary' disabled style='font-size: 13px;'>NO PAYMENT AVAILABLE</label>";
            }

            $createTable .= "</td>";

            // $createTable .= "<td style='text-align:center;' >";

            // if($STATUS == 2)
            // {
            //     $createTable .= "<a href='finance-enrollment-registration-process-form.php?process_id=$ID'>
            //     <label type='label' class='btn btn-secondary' onSubmit='window.location.reload()' style='font-size: 13px;'>PROCESS STUDENT </label></a>";            
            // }
            // if($STATUS == 3)
            // {
            //     $createTable .= "<a href='finance-enrollment-registration-process-form.php?enroll_id=$ID'>
            //     <label type='label' class='btn btn-warning' onSubmit='window.location.reload()' style='font-size: 13px;'>SEND COE / OR </label></a>";             
            // }

            // $createTable .= "</td>";
            

            $createTable .= "</tr>";
        }

        $createTable .= "</tbody>";
        $createTable .= "</table>";
        
        echo $createTable;
        
        $rsreg->close();
        //$dbConn->close();
    ?>
    <br>
    <br>
    </div>
       
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>