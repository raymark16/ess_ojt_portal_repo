<?php
    session_start();


    include('controller/ess-controller.php');

    if(isset($_GET['prcss_id']))
    {
        $userid = $_GET['prcss_id'];

        $qry = "UPDATE school_enrollment_pre_registration 
                SET schlenrollprereg_verification = 2
                WHERE schlenrollprereg_id = $userid";

        mysqli_query($dbConn, $qry);  

        echo "<script type='text/javascript'>alert('Student is Processed Successfully')</script>";
        echo "<script type='text/javascript'>location.href='" .$_SESSION['DASHBOARD'] . "'</script>";

    }
    
        $qryreg_ess = "SELECT `reg`.`schlenrollprereg_regdate` `REG_DATE`,
                UPPER(CONCAT(`reg`.`schlenrollprereg_lname`, ', ', `reg`.`schlenrollprereg_fname` , ' ' , `reg`.`schlenrollprereg_mname`)) `NAME`,
                UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
                UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
                UPPER(`crse`.`schlacadcrse_code`) `CRSE_NAME`, 
                `reg`.`schlusr_id` `USER_ID`,
                `reg`.`schlenrollprereg_verification` `VERIFY`, 
                `reg`.`schlenrollprereg_id` `ID`

                FROM `school_enrollment_pre_registration` `reg`
                    LEFT JOIN `school_academic_level` `lvl`
                        ON `reg`.`acadlvl_id`=`lvl`.`schlacadlvl_id`
                    LEFT JOIN `school_academic_year_level` `yrlvl`
                        ON `reg`.`acadyrlvl_id`=`yrlvl`.`schlacadyrlvl_id`
                    LEFT JOIN `school_academic_course` `crse`
                        ON `reg`.`acadcrse_id`=`crse`.`schlacadcrse_id`
                    LEFT JOIN `school_users` `usr`
                        ON `reg`.`schlusr_id`=`usr`.`schlusr_id` 
                    WHERE `reg`.`ready_for_assesment` >= 0 
                    AND `reg`.`schlenrollprereg_verification` < 3
                    AND `reg`.`schlusr_id` = ". $_SESSION['USERID'] ."
                    ORDER BY `reg`.`schlenrollprereg_verification` DESC, `reg`.`schlenrollprereg_regdate` DESC";

        $rsreg_ess = $dbConn->query($qryreg_ess);
        $fetchDatareg_ess = $rsreg_ess->fetch_ALL(MYSQLI_ASSOC);


    if(isset($_GET['student_id']))
    {   
        $_SESSION['student_ID'] = $_GET['student_id'];
        echo "<script type='text/javascript'>location.href='ess-verification-form.php'</script>";
    }


?>

<head>
    <meta charset="utf-8">
    <link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="tool/jquery-3.6.0.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/fcpc_logo_2.ico">
    <title> ESS DASHBOARD</title>
    <title></title>
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
            <h1 align="center" style="font-size: 50px; font-family: 'Times New Roman', Times, serif;color: blue;">FIRST CITY PROVIDENTIAL COLLEGE</h1>
            <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> ESS MANAGEMENT DASHBOARD </div>
        <br>
        <div class="row">
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
            <div class="col-md-2"></div>
            <div class="col-md-4">
            <form class="d-flex">
                    <a class="dropdown-item" disabled></a>
                    <a href="ess-enrollment-registration-process-form.php?logout='1'"><button type='button' class='btn btn-danger'>LOGOUT </button></a>
            </form>
            </div>
            
        </div>
    </div>
        <br>
    <div class="container" id="table-list">
            <div id="prereg-data"></div>
            <?php
        $createTable  = "<table id='regtable' class='table table-hover table-responsive table caption-top'>";
        $createTable .= "<thead class='table-primary'>";
        $createTable .= "<tr>";
        $createTable .= "<th scope='col' style='text-align:center;'>#</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>REGISTRATION DATE</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>STUDENT NAME</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>ACADEMIC LEVEL</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>GRADE/YEAR LEVEL</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>COURSE/STRAND</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>STATUS</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>ACTIONS</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>REMARKS</th>";

        
        $createTable .= "</tr>";
        $createTable .= "</thead>";
        $createTable .= "<tbody>";
        $createTable .= "<div></div>";
        $count = 1;
        foreach($fetchDatareg_ess as $regitem)
        {   

            $createTable .= "<tr>";
            $createTable .= "<td style='text-align:center;' class='table-primary'>".$count++."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['REG_DATE']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['LVL_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['YRLVL_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['CRSE_NAME']."</td>";

            if($regitem['VERIFY'] == NULL)
            {
                $createTable .= "<td style='text-align:center; ' >";
                $createTable .= "<label type='label' class='btn btn-outline-secondary' disabled>TO BE VERIFIED</label>";
                $createTable .= "</td>";
            }


            if($regitem['VERIFY'] == 0)
            {   
                $createTable .= "<td style='text-align:center; ' >";
                $createTable .= "<label type='label' class='btn btn-outline-secondary' disabled>TO BE VERIFIED</label>";
                $createTable .= "</td>";

            }
            if($regitem['VERIFY'] == 1)
            {
                $createTable .= "<td style='text-align:center;' >";
                $createTable .= "<label type='label' class='btn btn-outline-primary ' disabled>TO BE PROCESSED</label>";
                $createTable .= "</td>";

            }
            else if($regitem['VERIFY'] == 2)
            {
                $createTable .= "<td style='text-align:center;' >";
                $createTable .= "<label type='label' class='btn btn-success' disabled>STUDENT PROCESSED</label>";
                $createTable .= "</td>";

            }

            $createTable .= "<td style='text-align:center;' >";
            $createTable .= "<div class='btn-group d-grid gap-2 d-md-block' role='group' aria-label='Basic example'>";
            $createTable .= "<a href='ess-enrollment-registration-process-form.php?student_id=".$regitem['ID']."' ><button type='button' class='btn btn-primary' onSubmit='window.location.reload()'' >VIEW PROFILE</button></a>";
            //$createTable .= "<input type='text' id='".$regitem['ID']."' name='prereg_id' value='".$regitem['ID']."'>";

            if($regitem['VERIFY'] == 1)
            {
                $createTable .= "<td style='text-align:center;' >";
                $createTable .= "<a href='ess-enrollment-registration-process-form.php?prcss_id=".$regitem['ID']."'><button type='button' class='btn btn-warning'>PROCESS STUDENT</button></a>";
                $createTable .= "<input type='hidden'  id=".$regitem['ID']."' name='submit' value='".$regitem['ID']."'>";
                $createTable .= "</td>";
            }
            if($regitem['VERIFY'] == 2)
            {
                $createTable .= "<td style='text-align:center;' >";
                $createTable .= "<button type='button' class='btn btn-outline-success'>TRANSFERRED TO FINANCE</button";
                $createTable .= "</td>";
            }
            $createTable .= "</div>";
            $createTable .= "</td>";
            //$createTable .= "<td>".$regitem['ID']."</td>";
            $createTable .= "</tr>";


        }

        echo $createTable;
        
        $rsreg->close();
        ?>

    </div>

</body>


