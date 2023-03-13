<?php


    include('controller/ess-controller.php');

    if(isset($_GET['student_id']))
    {   
        $_SESSION['student_ID'] = $_GET['student_id'];
        echo "<script type='text/javascript'>location.href='test.php'</script>";
    }
    

?>

<head>
    <link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="tool/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="images/fcpc_logo_2.ico">
    <title> TEAMLEADER DASHBOARD</title>
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
        <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> ESS TEAM LEADER
            MANAGEMENT DASHBOARD </div>
        <br>
    </div>
    <div class="container">
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
                    <a href="teamleader-enrollment-registration-process-form.php?logout='1'"><button type='button'
                            class='btn btn-danger'>LOGOUT </button></a>
                </form>
            </div>

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
        $createTable .= "<th scope='col' style='text-align:center;'>ESS STAFF ASSIGNED </th>";
        $createTable .= "<th scope='col' style='text-align:center;'>STATUS</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>ACTIONS</th>";
        $createTable .= "<th scope='col' style='text-align:center;'>REMARKS</th>";

        
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
            $createTable .= "<td style='text-align:center;' >".$regitem['LVL_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['YRLVL_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >".$regitem['CRSE_NAME']."</td>";
            $createTable .= "<td style='text-align:center;' >";
            $createTable .= "<div class='dropdown'>";
                if($regitem['VERIFY'] == 2)
                {   

                    $createTable .= "<select id='user-list".$regitem['ID']."' name='user-list' class='form-control dropdown' disabled>";
                    $createTable .= "<option value='0'>Unassigned</option>";

                    foreach($fetchDatauser as $useritem)
                    {
                        if ($regitem['USER_ID'] == $useritem['USER_ID'])
                        {
                            $createTable .= "<option value='".$useritem['USER_ID'].",".$regitem['ID']."' selected>".$useritem['NAME']."</option>";
                        } 
                        else 
                        {
                            $createTable .= "<option value='".$useritem['USER_ID'].",".$regitem['ID']."'>".$useritem['NAME']."</option>";
                        }
                    }   
                    $createTable .= "</select>";

                }
                else
                {
                    $createTable .= "<select id='user-list".$regitem['ID']."' name='user-list' class='form-control dropdown'>";
                    $createTable .= "<option value='0'>Unassigned</option>";

                    foreach($fetchDatauser as $useritem)
                    {
                        if ($regitem['USER_ID'] == $useritem['USER_ID'])
                        {
                            $createTable .= "<option value='".$useritem['USER_ID'].",".$regitem['ID']."' selected>".$useritem['NAME']."</option>";
                        } 
                        else 
                        {
                            $createTable .= "<option value='".$useritem['USER_ID'].",".$regitem['ID']."'>".$useritem['NAME']."</option>";
                        }
                    }
                $createTable .= "</select>";
                }

            $createTable .= "</div'>";
            $createTable .= "</td>";

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
            $createTable .= "<a href='dashboard_associate.php?student_id=".$regitem['ID']."' ><button type='button' class='btn btn-primary' onSubmit='window.location.reload()'' >VIEW PROFILE</button></a>";
            //$createTable .= "<input type='text' id='".$regitem['ID']."' name='prereg_id' value='".$regitem['ID']."'>";

            if($regitem['VERIFY'] == 1)
            {
                $createTable .= "<td style='text-align:center;' >";
                $createTable .= "<a href='dashboard_associate.php?prcss_id=".$regitem['ID']."'><button type='button' class='btn btn-warning'>PROCESS STUDENT</button></a>";
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
    <div class="container" hidden>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php include 'pagination.php' ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-8">&nbsp;</div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('select').on('change', function () {
                //alert(this.value);
                let text = this.value;
                const myArray = text.split(",");
                //alert(myArray[0]);
                var userid = myArray[0];
                var regid = myArray[1];
                $.ajax({
                    type: 'POST',
                    url: 'controller/class/database/update_school_enrollment_pre_registration_userid.php',
                    data: {
                        userid: userid,
                        regid: regid
                    },
                    success: function (data) {
                        //$("#loader").hide();
                        //alert('GOOD '+regid+' '+userid);
                        //alert(data);
                    }
                });
            });
        });
    </script>
</body>