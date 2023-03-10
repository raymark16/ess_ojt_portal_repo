<?php

    include('controller/finance-controller.php');
    include('controller/finance_student_view.php');   

    $_SESSION['LINK'] = 'finance-verification-form.php';

    $_SESSION['STUDENT-FNAME'];
    $_SESSION['STUDENT-LNAME'];
    $_SESSION['STUDENT-MNAME'];
    $_SESSION['STUDENT-SNAME'];

    $_SESSION['STUDENT-NUM'];
    $_SESSION['STUDENT-TEL'];
    $_SESSION['STUDENT-EMAIL'];
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
                        <p>TESTING</p>
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
            <p>Last name *</p>
            <input type="text" id="lastname" name="lastname" placeholder="<?php echo $_SESSION['STUDENT-LNAME'];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><p>First name *</p>
            <input type="text" id="firstname" name="firstname" placeholder="<?php echo $_SESSION['STUDENT-FNAME'];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3"><p>Middle name</p>
            <input type="text" id="middlename" name="middlename" placeholder="<?php echo $_SESSION['STUDENT-MNAME'];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3"><p>Suffix</p>
            <input type="text" id="suffix" name="suffix" placeholder="<?php echo  $_SESSION['STUDENT-SNAME']; ?>" class="form-control" maxlength="40" required disabled>
          </div>
        </div>

        <br>
        <br>
        <!-- CONTACT INFORMATION ADDRESS -->

        <div align="center" style="background-color: lightblue;"><h2>CONTACT INFORMATION</h2></div>
        <div class="row">
          <div class="col-md-3"><p>Mobile Number</p>
            <input type="text" id="mobilenumber" name="mobilenumber" placeholder="<?php echo $_SESSION['STUDENT-NUM'];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><p>Telephone</p>
            <input type="text" id="telephone" name="telephone" placeholder="<?php echo $_SESSION['STUDENT-TEL'];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><p>Email Address</p>
            <input type="text" id="emailaddress" name="emailaddress" placeholder="<?php echo $_SESSION['STUDENT-EMAIL'];?>" class="form-control" maxlength="40" required disabled>
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
                    <option><?php echo $receipt['transaction_type']; ?></option>
                </select>
            </div>

            <div class="col-md-6 amount bank">
                <label class="form-label" for="amount">Amount Paid *</label>
                <input type="number" id="amount" name="amount" placeholder="<?php echo $receipt['amount']; ?>"
                    class="form-control bank amount" maxlength="40" required disabled>
            </div>

        </div>
        <div class="row mb-3">
            <div class="col-md-4 bank" >
                <label for="bank" class="form-label">Bank Name *</label>
                <select id="bank" name="bank" class="form-control bank" required disabled>
                    <option><?php echo $receipt['bank']; ?></option>
                    
                </select>
            </div>
            <div class="col-md-4 bank">
                <label class="form-label" for="referenceNumber">Transaction Reference Number *</label>
                <input type="text" id="referenceNumber" name="referenceNumber"
                   placeholder="<?php echo $receipt['reference_number']; ?>" class="form-control bank" maxlength="40" required disabled>
            </div>
            <div class="col-md-4 bank">
                <label class="form-label" for="date">Transaction date *</label>
                <input type="text" id="date" name="date" placeholder="<?php echo $receipt['date']; ?>" class="form-control bank" required disabled>
            </div>
        </div>
        <div class="row bank" hidden>
            <div class="col-md-8">
                <label class="form-label" for="receipt">Image/Scanned/Screenshot of Transaction Receipt *</label>
                <input
                    accept="image/jpeg,image/jpg,image/png,application/pdf,application/msword,application/vnd.ms-excel"
                    type="file" id="receipt" name="receipt" placeholder="Transaction date" class="form-control bank">
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
                if($receipt['receipt_id'] != null){
                    foreach($documents as $document){
                        $location = $document['document_location'];
                        $location = explode('UPLOADS/',$location)[1];
                        if($document['document_id'] == $receipt['receipt_id'])
                        {
                            $loc = $document['document_location'];

                            //FOR LIVE WEBSITE
                            $filename = explode("/", $loc);
                            $dir = $filename[8];  
                            $file = $filename[9]; 
                        

                            // FOR LOCAL WEBSITE
/*                          $filename = explode("\\", $loc);
                            $dir = $filename[0];
                            $file = $filename[1];
                        
                            //echo $dir;
                            //echo "<-->".$file;*/

                            $_SESSION['dir'] = $dir;
                            $_SESSION['file'] = $file;

                                         
                            echo "<a href='download.php?file=$file'><label class='btn btn-info' style = 'font-size: 20;'><span class='iconify' data-icon='bx:download'></span>Download File</label></a>";
                        }
                    }
                }elseif($receipt['transaction_type'] == 'credit-card'){
                    echo 'Credit card payment option selected';
                }elseif($receipt['transaction_type'] == 'student-inquiry'){
                    echo 'Student inquiry (Remaining balance) option selected';
                }else{
                    echo 'Receipt unavailable, contact support.';
                }
            }else{
                echo 'Receipt not uploaded yet.';
            }
            echo '</div>';
        ?>

        <br>

        </div>
        <hr>
        <div align="center">
            <!--<button type="button" id="submit-registration" class="btn btn-primary" value="Save to database">Submit my Online Registration</button>-->
            <!--<input type="button" id="submit-registration" name="submit-registration" class="btn btn-primary" value="Register Now" style = "font-size: 40;">-->

        <?php 

            if($receipt == !null)
            {
        ?>
            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="VERIFY" style = "font-size: 40;">
        <?php  
            }
        echo"<a href='finance-enrollment-registration-process-form.php' style = 'font-size: 40;'
                <label type='label'class='btn btn-primary' onSubmit='window.location.reload()''>
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

</html>
