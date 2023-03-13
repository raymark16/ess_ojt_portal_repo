<?php 
	echo 'HELLO WORLD';

	include('controller/finance-controller.php');



	unset($_SESSION['student_ID']);
    unset($_SESSION['STUDENT_TYPE']);

    if(isset($_GET['userid']) || isset($_GET['stud_type']))
    {   
        $_SESSION['STUDENT_TYPE'] = $_GET['stud_type'];
        $_SESSION['student_ID'] = $_GET['userid'];

        header('location: finance-verification-form.php');
    }
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="tool/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="images/fcpc_logo_2.ico">
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
        <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> FINANCE
            MANAGEMENT DASHBOARD </div>
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
        <div class="container" id="table-list">
        <div id="prereg-data"></div>
        <?php



        $createTable  = "<table id='regtable' class='table table-hover table-responsive table caption-top'>";
        $createTable .= "<thead class='table-primary'>";
        $createTable .= "<tr>";
        $createTable .= "<th scope='col' style='text-align:center;'>#</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Timestamp</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Student Name</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Student Type</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Level</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Grade Level</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Course Strand</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>STATUS</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Actions</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>Remarks</th>";

        //$createTable .= "<th scope='col'>ID</th>";
        $createTable .= "</tr>";
        $createTable .= "</thead>";
        $createTable .= "<tbody>";
        $createTable .= "<div></div>";
        $count = 1;
        foreach($fetchDatareg as $regitem)
        {   
            $createTable .= "<tr>";
            $createTable .= "<td style='text-align:center;' class='table-primary'>".$count++."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['REG_DATE']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['STUDENT_TYPE']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['LVL_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['YRLVL_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['CRSE_NAME']."</td>";

            if($regitem['STUDENT_TYPE'] == 'payment_only' || $regitem['STUDENT_TYPE'] == 'PAYMENT_ONLY')
            {
                $getReceipt = mysqli_query($dbConn, "SELECT * FROM oc_payments WHERE account_id = ".$regitem['OC_USER_ID'] );
                $ID     = $regitem['OC_USER_ID'];
                $TYPE   = $regitem['STUDENT_TYPE'];
            }
            else
            {
                $getReceipt = mysqli_query($dbConn, "SELECT * FROM oc_payments WHERE registration_id = ".$regitem['ID']  );
                $ID = $regitem['ID'];
                $TYPE   = $regitem['STUDENT_TYPE'];
            } 
            $receipt    = $getReceipt->fetch_ALL(MYSQLI_ASSOC);



            $createTable .= "<td style='text-align:center;' >";

            if($regitem['VERIFY'] == 2)
            {
                $createTable .= "<label type='label' class='btn btn-outline-secondary' disabled>STUDENT PROCESSED</label>";

            }
            if($regitem['VERIFY'] == 3)
            {
                $createTable .= "<label type='label' class='btn btn-outline-primary' disabled>FINANCE VERIFIED</label>";
            }
            else if($regitem['VERIFY'] == 4)
            {
                $createTable .= "<label type='label' class='btn btn-success' disabled>STUDENT ENROLLED</label>";
            }
            $createTable .= "</td>";

            $createTable .= "<div class='btn-group' role='group' aria-label='Basic example'>";

            $createTable .= "<td style='text-align:center;' >";
            if($receipt !=null)
            {
                //$createTable .= "<a href='finance-verification-form.php?userid=".$regitem['VIEW']."' >                                    <label type='label' class='btn btn-primary' onSubmit='window.location.reload()''>VIEW PAYMENT FORM</label></a>";    

                $createTable .= "<a href='finance-enrollment-registration-process-form.php?userid=$ID&stud_type=$TYPE'>                   
                <label type='label' class='btn btn-primary' onSubmit='window.location.reload()''>VIEW PAYMENT FORM</label></a>";
            }
            else
            {
                $createTable .= "<label type='label' class='btn btn-secondary' disabled>NO PAYMENT AVAILABLE</label>";

                //$createTable .= "<a href='finance-verification-form.php?userid=".$regitem['ID']."' >                                        <label type='label' class='btn btn-primary' onSubmit='window.location.reload()''>VIEW PAYMENT FORM</label></a>";
            }

            if($regitem['VERIFY'] == 3)
            {
                $createTable .= "<td style='text-align:center;' >";
                $createTable .= "<a href='controller/finance-controller.php?prcss_id=".$ID."'><button type='button' class='btn btn-warning' >SEND COE/OR </button></a>";
                //$createTable .= "<input type='hidden'  id=".$regitem['PROCESS']."' name='submit' value='".$regitem['PROCESS']."'>";
                $createTable .= "</td>";
            }
            if($regitem['VERIFY'] == 4)
            {
                $createTable .= "<td style='text-align:center;'>";
                $createTable .= "<label type='label' class='btn btn-outline-success' disabled>CERTIFICATE OF ENROLLMENT IS SENT</label>";
                $createTable .= "</td>";
            }

            //$createTable .= "<input type='text' id='".$regitem['PROCESS']."' name='prereg_id' value='".$regitem['PROCESS']."'>";
            $createTable .= "</div>";
            $createTable .= "</td>";
            //$createTable .= "<td>".$regitem['VIEW']."</td>";
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
</body>



