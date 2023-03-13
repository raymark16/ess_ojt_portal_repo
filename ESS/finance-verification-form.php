<?php

    // include('controller/finance_student_view.php');  

    session_start();

    // $servername = "localhost";
    // $serverusername = "dbessportal";
    // $serverpassword = "FCPCsince1984";
    // $serverdb = "fcpconlinecampus";

    $servername = "localhost";
    $serverusername = "root";
    $serverpassword = "";
    $serverdb = "fcpc";


    // Create connection
    $dbConn = mysqli_connect($servername,$serverusername,$serverpassword,$serverdb);

    // Check connection
    if (!$dbConn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $dbConn = mysqli_connect($servername,$serverusername,$serverpassword,$serverdb);

    // for getting info of students

    $userid = $_SESSION['student_ID'];

    $qry = "SELECT * FROM `school_enrollment_pre_registration` WHERE `schlenrollprereg_id` = ". $userid;

    $getprofile = $dbConn->query($qry);
    $profile = $getprofile->fetch_array(MYSQLI_ASSOC);

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

    // for getting payment details

    $payment_id = $_SESSION['payment_id'];

    $qry = " SELECT * FROM `oc_enrollment_payments` WHERE `id` = " . $payment_id;

    $rsreg = $dbConn->query($qry);
    $payment_details = $rsreg->fetch_array(MYSQLI_ASSOC);


    // verifying payment 


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

<html>  
<head>
    <link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="tool/jquery-3.6.0.min.js"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <link rel="icon" href="image/fcpc_logo_2.ico">

    <title> VERIFICATION FORM </title>


    <style>
        .bs-example
        {
            margin: 20px;
        }

        label
        {
            color: royalblue;
            font-weight: bold;
            display: block;
            float: left;
        }
        </style>
</head>
<body style="border:1px solid background: 
                                  rgba(0,0,0,0.01); 
                                  background-image: url('image/FCPC LOGO.png');
                                  background-size: 70%;
                                  background-repeat: no-repeat;
                                  background-position: center;
                                  padding-bottom: 0;
                                  padding-top: 0;
                                  background-op;">
    <br>
    <h1 align="center" style="font-size: 50px; font-family: 'Times New Roman', Times, serif;color: blue;">FIRST CITY PROVIDENTIAL COLLEGE</h1>
          <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> STUDENT REGISTRATION INFORMATION </div>
    <h4 align="center" style="font: normal normal normal 25px/30px Times New Roman, Times, serif; text-decoration-line: underline;">
        (A.Y. 2022-2023)
    </h4>
    <div class="bs-example">
        <div id="myModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label>TESTING</label>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Save</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container">
        <hr>
        <div align="center" style="background-color: lightblue;">
            <h2>STUDENT INFORMATION</h2>
        </div>
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" label="close">×</a>
        </div>
        
    <form method="post" action="" enctype="multipart/form-data" id="myform">

        <div class="row">
          <div class="col-md-3">
            <label>Last name *</label>
            <input type="text" id="lastname" name="lastname" placeholder="<?php echo $_SESSION['STUDENT-LNAME'];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><label>First name *</label>
            <input type="text" id="firstname" name="firstname" placeholder="<?php echo $_SESSION['STUDENT-FNAME'];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3"><label>Middle name</label>
            <input type="text" id="middlename" name="middlename" placeholder="<?php echo $_SESSION['STUDENT-MNAME'];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3"><label>Suffix</label>
            <input type="text" id="suffix" name="suffix" placeholder="<?php echo  $_SESSION['STUDENT-SNAME']; ?>" class="form-control" maxlength="40" required disabled>
          </div>
        </div>

        <br>
        <br>
        <!-- CONTACT INFORMATION ADDRESS -->

        <div align="center" style="background-color: lightblue;"><h2>CONTACT INFORMATION</h2></div>
        <div class="row">
          <div class="col-md-3"><label>Mobile Number</label>
            <input type="text" id="mobilenumber" name="mobilenumber" placeholder="<?php echo $_SESSION['STUDENT-NUM'];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><label>Telephone</label>
            <input type="text" id="telephone" name="telephone" placeholder="<?php echo $_SESSION['STUDENT-TEL'];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><label>Email Address</label>
            <input type="text" id="emailaddress" name="emailaddress" placeholder="<?php echo $_SESSION['STUDENT-EMAIL'];?>" value="<?php echo $_SESSION['STUDENT-EMAIL'];?>" class="form-control" maxlength="40" required disabled>
          </div>
        </div>
        <br>

        <!-- PAYMENT INFORMATION -->

        <div align="center" class="mb-3" style="background-color: lightblue;"><h2>PAYMENT DOCUMENTS</h2></div>

        <?php

        if($receipt == !null)
        {
        ?>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="transaction" class="form-label">Transaction Type *</label>
                <select id="transaction" name="transaction" class="form-control" required disabled>
                    <option><?php echo $payment_details['transaction_type']; ?></option>
                </select>
            </div>

            <div class="col-md-6 amount bank">
                <label class="form-label" for="amount">Amount Paid *</label>
                <input type="number" id="amount" name="amount" placeholder="<?php echo $payment_details['amount']; ?>"
                    class="form-control bank amount" maxlength="40" required disabled>
            </div>

        </div>
        <div class="row mb-3">
            <div class="col-md-4 bank" >
                <label for="bank" class="form-label">Bank Name *</label>
                <select id="bank" name="bank" class="form-control bank" required disabled>
                    <option><?php echo $payment_details['bank']; ?></option>
                    
                </select>
            </div>
            <div class="col-md-4 bank">
                <label class="form-label" for="referenceNumber">Transaction Reference Number *</label>
                <input type="text" id="referenceNumber" name="referenceNumber"
                   placeholder="<?php echo $payment_details['reference_number']; ?>" class="form-control bank" maxlength="40" required disabled>
            </div>
            <div class="col-md-4 bank">
                <label class="form-label" for="date">Transaction date *</label>
                <input type="text" id="date" name="date" placeholder="<?php echo $payment_details['transaction_date']; ?>" class="form-control bank" required disabled>
            </div>
        </div>
        <div class="row bank">
            <div class="col-md-4">
                <label class="form-label text-danger" for="payment_type"> Select Payment Remarks *</label>
                <select id='payment_type' name='payment_type' class='form-control dropdown' required>  
                    <option value = "NULL,NULL"> -- Select Payment Remarks --  </option>

                    
                    <option value = "<?php echo $payment_details['id'] ?>,tuition"> Tuition Fee </option>
                    <option value = "<?php echo $payment_details['id'] ?>,installment" > Installments </option>
                </select>
            </div>
        </div>


    <?php 

        }
        else
        {
            echo 'Payment not available yet.';
        }

    ?>


        <br>
        <hr>

        <!-- STUDENT DOCUMENTS -->
         
        <div align="center" class="mb-3" style="background-color: lightblue;"><h2>STUDENT DOCUMENTS</h2></div>
        <?php
            echo '<div class="col-md-3">';
            if($receipt != null){
                if($receipt['receipt_id'] != null)
                {
                    foreach($documents as $document)
                    {
                        // echo "<label class='btn btn-success'>" . $document['document_id']  . "</label>";

                        $id = $document['document_id'];
                        if($document['document_id'] == $receipt['receipt_id'])
                        {
                            echo "  <a href='controller/DownloadController.php?id=$id'>
                                        <label class='btn btn-info form-control download_link download_link' style = 'font-size: 20;'>
                                            <span class='iconify' data-icon='bx:download'></span>View Document
                                        </label>
                                    </a>";
                        }

                                        
                    }

                }
                elseif($receipt['transaction_type'] == 'credit-card')
                {
                    echo 'Credit card payment option selected';
                }
                elseif($receipt['transaction_type'] == 'student-inquiry')
                {
                    echo 'Student inquiry (Remaining balance) option selected';
                }
                else
                {
                    echo 'Receipt unavailable, contact support.';
                }
            }else{
                echo 'Receipt not uploaded yet.';
            }
            echo '</div>';
        ?>

        <br><br>
        <hr>

        </div>
        <div align="center">
        <?php 

            if($receipt == !null)
            {
        ?>
            <input type="submit" id="verify_payment" name="verify_payment" class="btn btn-primary" value="VERIFY PAYMENT" style = "font-size: 40;">
        <?php  
            }
        echo"<a href='finance-student-transaction.php' style = 'font-size: 40;'
                <label type='label'class='btn btn-secondary' onSubmit='window.location.reload()''>
                    CANCEL
                </label>
            </a>";   
        ?>


            
        </div>
        <hr>
    
</div>
    <div class="container">
      <div class="row">
        <div class="col-mg-3" align="center"><h7>Copyrights © All right reserved 2021 FCPC</h7></div>
      </div>
      <div class="row">
        <div class="col-mg-3" align="center"><h5>First City Providential College, Inc.</h5></div>
      </div>
    </div>
    </form>

    <br>
    <br>

    

</body>

<script type="text/javascript">
        $(document).ready(function () {

            $('select').on('change', function () {
                let text = this.value;
                const myArray = text.split(",");
                //alert(myArray[0]);
                var receipt_id = myArray[0];
                var remarks = myArray[1];

                $.ajax({
                    type: 'POST',
                    url: 'controller/class/database/update_oc_enrollment_payments_remarks_by_type.php',
                    data: {
                        receipt_id: receipt_id,
                        remarks: remarks
                    },
                    success: function (data) {
                        // alert(data);
                    }
                });
            });
        });
    </script>


</html>
