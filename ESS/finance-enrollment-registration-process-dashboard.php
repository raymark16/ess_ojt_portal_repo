<?php

    include('controller/test-finance-controller.php');

    $_SESSION['DASHBOARD'] = 'finance-enrollment-registration-process-dashboard.php';

    unset($_SESSION['student_ID']);
    unset($_SESSION['STUDENT_TYPE']);

    if(isset($_GET['userid']) || isset($_GET['stud_type']))
    {   
        $_SESSION['STUDENT_TYPE'] = $_GET['stud_type'];
        $_SESSION['student_ID'] = $_GET['userid'];

        header('location: finance-verification-form.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="tool/jquery-3.6.0.min.js"></script> -->
    <link rel="icon" href="image/fcpc_logo_2.ico">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <title>TEST</title>

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
        <div class="container container-fluid">
        <div id="prereg-data"></div>

        <div id='finance-dasboard'>

            <table id='regtable' class='table table-hover '>   
                <thead class='table-primary'>   
                    <tr>    
                        <th scope='col' style='text-align:center;'>#</th>   
                        <th scope='col' style='text-align:center;'>Timestamp</th>   
                        <th scope='col' style='text-align:center;'>Student Name</th>    
                        <th scope='col' style='text-align:center;'>Student Type</th>    
                        <th scope='col' style='text-align:center;'>Level</th>   
                        <th scope='col' style='text-align:center;'>Grade Level</th> 
                        <th scope='col' style='text-align:center;'>Course Strand</th>   
                        <th scope='col' style='text-align:center;'>Status</th>  
                        <th scope='col' style='text-align:center;'>Payment Verified</th>    
                        <th scope='col' style='text-align:center;' colspan=2 >Actions</th>  
                    </tr>   
                </thead>    
                <tbody>
                    <tr>
                        <td colspan = 11 style="text-align: center; font-weight: bold;"> <label class="text-danger" > NO RECORD FOUND </label> </td>
                    </tr>
                </tbody>

        </div>

        <div id='student_transaction'>
            
        </div>

        <div id='payment_details'>
            
        </div>

    <br>
    <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                    <?php /*include 'controller/pagination-controller.php'*/ ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-8">&nbsp;</div>
        </div>
    </div>
       
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>