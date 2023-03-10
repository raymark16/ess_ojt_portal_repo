<?php
    include('controller/ess-controller.php');
    include('controller/ess-student-view.php');

    $_SESSION['LINK'] = 'enrollment.php';


?>

<html>  
    <head>
        <link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="tool/jquery-3.6.0.min.js"></script>
        <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
        <link rel="icon" href="images/fcpc_logo_2.ico">
        <title> VERIFICATION FORM</title>
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
            <h2>EDUCATIONAL INFORMATION</h2>
        </div>
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" label="close">×</a>
        </div>
        
    <form method="post" action="" enctype="multipart/form-data" id="myform">
        <div class="row">
            <div class="col-md-3">
                <p>Academic Level</p>
                    <select id="academiclevel-list" class="form-control" required disabled>
                        <option> <?php echo $acad_lvl['schlacadlvl_code']; ?> </option>
                    </select>
            </div>
            <div class="col-md-3">
                <p>Academic Year Level</p>
                    <select id="academicyearlevel-list" name="academic_year_level" class="form-control" required disabled>
                        <option><?php echo $acad_yrlvl["schlacadyrlvl_code"];?> </option>
                    </select>
            </div>
            <div class="col-md-3">
                <p>Student Type</p>
                    <input type="text" id="student_type" name="student_type" placeholder="<?php echo $profile["student_type"] . ' ' . $profile["studium_type"];?>" class="form-control" maxlength="40" required disabled>
            </div>
            <div class="col-md-3">
                <p>Academic Strand/Program/Course</p>
                    <select id="academiccourse-list" name="academic_course" class="form-control" required disabled>
                        <option><?php echo isset($acad_crse["schlacadcrse_name"]) ? $acad_crse["schlacadcrse_name"] : '';?> </option>
                    </select>
            </div>
            <div class="col-md-3">
                <label for="last_school_sector" class="form-label">Sector of Last School Attended</label>
                <select id="last_school_sector" name="last_school_sector" class="form-control last-school" disabled required>
                    <option><?php echo isset($profile["last_school_sector"]) ? $profile["last_school_sector"] : '';?> </option>
                </select>
            </div>
        </div>
        <br>
        <div align="center" style="background-color: lightblue;">
            <h2>STUDENT INFORMATION</h2>
        </div>
        <div class="row">
          <div class="col-md-3">
            <p>Last name</p>
            <input type="text" id="lastname" name="lastname" placeholder="<?php echo $profile["schlenrollprereg_lname"];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><p>First name</p>
            <input type="text" id="firstname" name="firstname" placeholder="<?php echo $profile["schlenrollprereg_fname"];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3"><p>Middle name</p>
            <input type="text" id="middlename" name="middlename" placeholder="<?php echo $profile["schlenrollprereg_mname"];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3"><p>Suffix</p>
            <input type="text" id="suffix" name="suffix" placeholder="<?php echo $profile["schlenrollprereg_suffix"];?>" class="form-control" maxlength="40" required disabled>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-3">
          <p>Age</p>
            <input type="text" id="age" name="age" placeholder="<?php echo $profile["schlenrollprereg_age"];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3">
            <p>Gender</p>
            <select id="gender-list" name="required_gender" class="form-control" required disabled>
                <option><?php echo $profile["schlenrollprereg_gender"];?> </option>
                
            </select>
          </div>
          <div class="col-md-3">
            <p>Birth date</p>
            <input type="text" id="birthdate" name="birthdate" placeholder="<?php echo $profile["schlenrollprereg_bdate"];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3">
            <p>Birth place</p>
            <input type="text" id="birthplace" name="birthplace" placeholder="<?php echo $profile["schlenrollprereg_bplace"];?>" class="form-control" maxlength="40" required disabled>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-3"><p>Nationality</p>
            <input type="text" id="nationality" name="nationality" placeholder="<?php echo $profile["schlenrollprereg_nationality"];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3"><p>Religion</p>
            <input type="text" id="religion" name="religion" placeholder="<?php echo $profile["schlenrollprereg_religion"];?>" class="form-control" maxlength="40" required disabled>
          </div>
          <div class="col-md-3"><p>Mother Tongue</p>
            <input type="text" id="mothertongue" name="mothertongue" placeholder="<?php echo $profile["schlenrollprereg_mothertongue"];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3">
            <p>Civil Status</p>
            <select id="civilstatus-list" name="civilstatus" class="form-control" required disabled>
                <option><?php echo $profile["schlenrollprereg_civilstatus"];?> </option>
                
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-3"><p>Number of Siblings</p>
            <input type="text" id="numberofsiblings" name="numberofsiblings" placeholder="<?php echo $profile["schlenrollprereg_noofsiblings"];?>" class="form-control" maxlength="40" required disabled>

          </div>
        </div>
        <br>

         <!-- STUDENT DOCUMENTS -->
         
        <div align="center" class="mb-3" style="background-color: lightblue;"><h2>STUDENT DOCUMENTS</h2></div>
        <?php
            echo '<div class="row">';
            foreach($documents as $document){
                $location = $document['document_location'];
                $location = explode('UPLOADS/',$location)[1];

                $loc = $document['document_location'];

                //FOR LIVE WEBSITE
                $filename = explode("/", $loc);
                $dir = $filename[8];  
                $file = $filename[9];
 
                        

                // FOR LOCAL WEBSITE
/*                $filename = explode("\\", $loc);
                $dir = $filename[0];
                $file = $filename[1];
*/
                $_SESSION['dir'] = $dir;            
                
                if($receipt != null)
                {
                    if($document['document_id'] != $receipt['receipt_id'])
                    {
                        echo '<div class="col-md-4 mb-3">';
           
                        echo "  <a href='download.php?file=$file'>
                                    <label class='btn btn-info form-control download_link download_link' style = 'font-size: 20;'>
                                        <span class='iconify' data-icon='bx:download'></span>View Document
                                    </label>
                                </a>";
                        echo '</div>';
                        }
                }
                else
                {
                        echo '<div class="col-md-4 mb-3">';
           
                        echo "  <a href='download.php?file=$file'>
                                    <label class='btn btn-info form-control download_link download_link' style = 'font-size: 20;'>
                                        <span class='iconify' data-icon='bx:download'></span>View Document
                                    </label>
                                </a>";
                        echo '</div>';

                }
            }
            echo '</div>';
        ?>
        <!-- CONTACT INFORMATION ADDRESS -->

        <div align="center" style="background-color: lightblue;"><h2>CONTACT INFORMATION</h2></div>
        <div class="row">
          <div class="col-md-3"><p>Mobile Number</p>
            <input type="text" id="mobilenumber" name="mobilenumber" placeholder="<?php echo $profile["schlenrollprereg_mobileno"];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><p>Telephone</p>
            <input type="text" id="telephone" name="telephone" placeholder="<?php echo $profile["schlenrollprereg_telno"];?>" class="form-control" maxlength="40" required disabled>

          </div>
          <div class="col-md-3"><p>Email Address</p>
            <input type="text" id="emailaddress" name="emailaddress" placeholder="<?php echo $profile["schlenrollprereg_emailadd"];?>" class="form-control" maxlength="40" required disabled>
          </div>
        </div>
        <br>

        <!-- PRESENT ADDRESS -->

        <div align="center" style="background-color: lightblue;"><h2>PRESENT ADDRESS</h2></div>
        <div class="row">
            <div class="col-md-6">
                <p>Street Address</p>
            <input type="text" id="present-streetaddress" name="present-streetaddress" placeholder="<?php echo $profile['schlenrollprereg_present_streetadd'];?>" class="form-control" maxlength="40" required disabled>
            </div>
            <div class="col-md-3">
                <p>Province</p>
                    <select id="present-province-list" name="present-province" class="form-control" required disabled>
                        <option><?php echo $pres_loc_prov["philarealocprov_name"];?> </option>
                    </select>
                
            </div>
            <div class="col-md-3">
                <p>Municipality</p>
                    <select id="present-municipality-list" name="present-municipality" class="form-control" required disabled="">
                        <option><?php echo $pres_loc_mun["philarealocmun_name"];?> </option>
                    </select>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <p>Barangay</p>
                    <select id="present-barangay-list" name="present-barangay" class="form-control" required disabled="">
                        <option><?php echo $pres_loc_brgy["philarealocbrgy_name"];?> </option>
                    </select>
            </div>
            <div class="col-md-3">
                <p>Zipcode</p>
                    <input type="text" id="present-zipcode" name="present-zipcode" placeholder="<?php echo $profile['schlenrollprereg_present_zipcode'];?>" class="form-control" maxlength="40" required disabled>

            </div>
        </div>
        <br>

        <!-- PERMANENT ADDRESS -->

        <div align="center" style="background-color: lightblue;"><h2>PERMANENT ADDRESS</h2></div>
        <div class="row">
            <div class="col-md-6">
                <p>Street Address</p>
            <input type="text" id="permanent-streetaddress" name="permanent-streetaddress" placeholder="<?php echo $profile['schlenrollprereg_permanent_streetadd'];?>" class="form-control" maxlength="40" required disabled>
            </div>
            <div class="col-md-3">
                <p>Province</p>
                    <select id="permanent-province-list" name="permanent-province" class="form-control" required disabled>
                        <option><?php echo $perma_loc_prov["philarealocprov_name"];?> </option>
                    </select>
                
            </div>
            <div class="col-md-3">
                <p>Municipality</p>
                    <select id="permanent-municipality-list" name="permanent-municipality" class="form-control" required disabled="">
                        <option><?php echo $perma_loc_mun["philarealocmun_name"];?> </option>
                    </select>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <p>Barangay</p>
                    <select id="permanent-barangay-list" name="permanent-barangay" class="form-control" required disabled="">
                        <option><?php echo $perma_loc_brgy["philarealocbrgy_name"];?> </option>
                    </select>
            </div>
            <div class="col-md-3">
                <p>Zipcode</p>
                    <input type="text" id="permanent-zipcode" name="permanent-zipcode" placeholder="<?php echo $profile['schlenrollprereg_permanent_zipcode'];?>" class="form-control" maxlength="40" required disabled>

            </div>
            <?php
                if($profile['acadyrlvl_id'] >= 10 && $profile['acadyrlvl_id'] <= 14){
                    echo '<div class="col-md-6">';
                    echo '<p>ESC or SHS</p>';
                    echo '<select id="esc_or_shs" name="esc_or_shs" class="form-control" required>';

                        if($profile['acadyrlvl_id'] <= 12){

                            echo '<option value="WITHOUT ESC">WITHOUT ESC</option>';
                            echo '<option value="WITH ESC">WITH ESC</option>';

                        }elseif($profile['acadyrlvl_id'] == 13){ // GRADE 11

                            echo '<option value="WITHOUT ESC CERT OR SHS VOUCHER">WITHOUT ESC CERT OR SHS VOUCHER</option>';
                            echo '<option value="WITH ESC CERT OR SHS VOUCHER">   WITH ESC CERT OR SHS VOUCHER</option>';

                        }elseif($profile['acadyrlvl_id'] == 14){ // GRADE 12 

                            echo '<option value="WITHOUT SHS VOUCHER">WITHOUT SHS VOUCHER</option>';
                            echo '<option value="WITH SHS VOUCHER PUBLIC">WITH SHS VOUCHER</option>';
                            echo '<option value="WITH SHS VOUCHER PRIVATE">WITH SHS VOUCHER PRIVATE</option>';
                        }
                    echo '</select>';
                    echo '</div>';
                }
            ?>
        </div>


        </div>
        <hr>
        <div align="center">
            <!--<button type="button" id="submit-registration" class="btn btn-primary" value="Save to database">Submit my Online Registration</button>-->
            <!--<input type="button" id="submit-registration" name="submit-registration" class="btn btn-primary" value="Register Now" style = "font-size: 40;">-->

            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="VERIFY" style = "font-size: 40;">
            
            <input type="button" class="btn btn-primary" style = "font-size: 40;" 
            onclick="window.location.href = '<?php echo $_SESSION['DASHBOARD']?>';" value="CANCEL"/>            
        </div>
        <hr>
    </form>
</div>
    <div class="container">
      <div class="row">
        <div class="col-mg-3" align="center"><h7>Copyrights © All right reserved 2021 FCPC</h7></div>
      </div>
      <div class="row">
        <div class="col-mg-3" align="center"><h5>First City Providential College, Inc.</h5></div>
      </div>
    </div>
    <br>
    <br>

    <!-- <script src="assets/js/download.js"></script> --> 

</body>

</html>
