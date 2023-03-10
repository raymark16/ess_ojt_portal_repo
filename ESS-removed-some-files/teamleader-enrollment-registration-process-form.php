<?php

include('controller/ess-controller.php');


?>

<head>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="tool/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="image/fcpc_logo_2.ico">
    <script src="js/ess-verification-form.js"></script>
    <title> TEAMLEADER DASHBOARD</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>
    <style>
        #regtable_length label,
        #regtable_filter label {
            font-family: inherit;
            text-transform: uppercase;
            color: inherit;
            margin-bottom: 5px;

        }

        .bs-example {
            margin: 20px;
        }
    </style>
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
    <div class="container" id="teamleader-enrollment-registration-process">
        <div class="container">
            <br>
            <h1 align="center" style="font-size: 50px; font-family: 'Times New Roman', Times, serif;color: blue;">FIRST
                CITY
                PROVIDENTIAL COLLEGE</h1>
            <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> ESS TEAM
                LEADER
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

        <br>
        <div class="container" id="table-list">
            <div id="prereg-data"></div>
            <table id='regtable' class='table table-hover table-bordered' style="font-size:13px; width=100%">
                <thead class='table-primary'>
                </thead>
                <tbody id='finance-records'>
                    <tr style="text-align: center;">
                        <td colspan="10">
                            <label class="text-danger" style="text-align: center;"> NO RECORD FOUND </label>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <!-- ##################################################################################################### -->
    <!-- ESS VERIFICATION FORM -->


    <div class="container" id="ess-verification">
        <h1 align="center" style="font-size: 50px; font-family: 'Times New Roman', Times, serif;color: blue;">FIRST CITY
            PROVIDENTIAL COLLEGE</h1>
        <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> STUDENT
            REGISTRATION INFORMATION </div>
        <h4 align="center"
            style="font: normal normal normal 25px/30px Times New Roman, Times, serif; text-decoration-line: underline;">
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
                        <input type="text" id="academiclevel-list" class="form-control" class="form-control"
                            maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Academic Year Level</p>
                        <input type="text" id="academicyearlevel-list" class="form-control" class="form-control"
                            maxlength="40" required disabled>
    
                    </div>
                    <div class="col-md-3">
                        <p>Student Type</p>
                        <input type="text" id="student_type" name="student_type"
                            class="form-control" maxlength="40" required disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <p>Academic Strand/Program/Course</p>
                        <input type="text" id="academiccourse-list" name="academic_course"
                            class="form-control" maxlength="40" required disabled>
                
                    </div>
                    <div class="col-md-3">
                        <p>Sector of Last School Attended</p>
                        <input type="text" id="last_school_sector" name="last_school_sector"
                            class="form-control" maxlength="40" required disabled>
                    </div>
                </div>
                <br>


                <div align="center" style="background-color: lightblue;">
                    <h2>STUDENT INFORMATION</h2>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p>Last name</p>
                        <input type="text" id="lastname" name="lastname"
                           class="form-control"
                            maxlength="40" required disabled>

                    </div>
                    <div class="col-md-3">
                        <p>First name</p>
                        <input type="text" id="firstname" name="firstname"
                           class="form-control"
                            maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Middle name</p>
                        <input type="text" id="middlename" name="middlename"
                           class="form-control"
                            maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Suffix</p>
                        <input type="text" id="suffix" name="suffix"
                            class="form-control"
                            maxlength="40" required disabled>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <p>Age</p>
                        <input type="text" id="age" name="age"
                            class="form-control"
                            maxlength="40" required disabled>

                    </div>
                    <div class="col-md-3">
                        <p>Gender</p>
                        <input type="text" id="gender-list" name="required_gender"
                            class="form-control"
                            maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Birth date</p>
                        <input type="text" id="birthdate" name="birthdate"
                            class="form-control"
                            maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Birth place</p>
                        <input type="text" id="birthplace" name="birthplace"
                            class="form-control"
                            maxlength="40" required disabled>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <p>Nationality</p>
                        <input type="text" id="nationality" name="nationality"
                            class="form-control"
                            maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Religion</p>
                        <input type="text" id="religion" name="religion"
                            class="form-control"
                            maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Mother Tongue</p>
                        <input type="text" id="mothertongue" name="mothertongue"
                            class="form-control"
                            maxlength="40" required disabled>

                    </div>
                    <div class="col-md-3">
                        <p>Civil Status</p>
                        <input type="text" id="civilstatus-list" name="civilstatus"
                            class="form-control"
                            maxlength="40" required disabled>
                       
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <p>Number of Siblings</p>
                        <input type="text" id="numberofsiblings" name="numberofsiblings"
                            class="form-control"
                            maxlength="40" required disabled>

                    </div>
                </div>
                <br>

                <!-- STUDENT DOCUMENTS -->

                <div align="center" class="mb-3" style="background-color: lightblue;">
                    <h2>STUDENT DOCUMENTS</h2>
                </div>
                <div id='view_document_section' class="col-md-3" style='display: flex;'>
						
				</div>
                <!-- CONTACT INFORMATION ADDRESS -->

                <div align="center" style="background-color: lightblue;">
                    <h2>CONTACT INFORMATION</h2>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p>Mobile Number</p>
                        <input type="text" id="mobilenumber" name="mobilenumber"
                            class="form-control"
                            maxlength="40" required disabled>

                    </div>
                    <div class="col-md-3">
                        <p>Telephone</p>
                        <input type="text" id="telephone" name="telephone"
                            class="form-control"
                            maxlength="40" required disabled>

                    </div>
                    <div class="col-md-3">
                        <p>Email Address</p>
                        <input type="text" id="emailaddress" name="emailaddress"
                           class="form-control"
                            maxlength="40" required
                            disabled>
                    </div>
                </div>
                <br>

                <!-- PRESENT ADDRESS -->

                <div align="center" style="background-color: lightblue;">
                    <h2>PRESENT ADDRESS</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p>Street Address</p>
                        <input type="text" id="present-streetaddress" name="present-streetaddress"
                            class="form-control" maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Province</p>
                        <input type="text" id="present-province-list" name="present-province"
                            class="form-control" maxlength="40" required disabled>

                    </div>
                    <div class="col-md-3">
                        <p>Municipality</p>
                        <input type="text" id="present-municipality-list" name="present-municipality"
                            class="form-control" maxlength="40" required disabled>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <p>Barangay</p>
                        <input type="text" id="present-barangay-list" name="present-barangay"
                            class="form-control" maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Zipcode</p>
                        <input type="text" id="present-zipcode" name="present-zipcode"
                            class="form-control" maxlength="40" required disabled>

                    </div>
                </div>
                <br>

                <!-- PERMANENT ADDRESS -->

                <div align="center" style="background-color: lightblue;">
                    <h2>PERMANENT ADDRESS</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p>Street Address</p>
                        <input type="text" id="permanent-streetaddress" name="permanent-streetaddress"
                            class="form-control" maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Province</p>
                        <input type="text" id="permanent-province-list" name="permanent-province"
                            class="form-control" maxlength="40" required disabled>
                        

                    </div>
                    <div class="col-md-3">
                        <p>Municipality</p>
                        <input type="text" id="permanent-municipality-list" name="permanent-municipality"
                            class="form-control" maxlength="40" required disabled>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <p>Barangay</p>
                        <input type="text" id="permanent-barangay-list" name="permanent-barangay"
                            class="form-control" maxlength="40" required disabled>
                    </div>
                    <div class="col-md-3">
                        <p>Zipcode</p>
                        <input type="text" id="permanent-zipcode" name="permanent-zipcode"
                            class="form-control" maxlength="40" required disabled>

                    </div>
                    <div class="col-md-6" id="ESCSHS" >
                        
                    </div>
                   
                </div>


        </div>
        <hr>
        <div align="center">
            <!--<button type="button" id="submit-registration" class="btn btn-primary" value="Save to database">Submit my Online Registration</button>-->
            <!--<input type="button" id="submit-registration" name="submit-registration" class="btn btn-primary" value="Register Now" style = "font-size: 40;">-->

            <button type="button" id="submit" class="btn btn-primary" name="Submit1" style="font-size: 40;" >VERIFY</button>
            <input type="button" id="return" class="btn btn-primary" style="font-size: 40;" value="CANCEL" />
        </div>
        <hr>
        </form>
        <div class="container">
        <div class="row">
            <div class="col-mg-3" align="center">
                <h7>Copyrights © All right reserved 2021 FCPC</h7>
            </div>
        </div>
        <div class="row">
            <div class="col-mg-3" align="center">
                <h5>First City Providential College, Inc.</h5>
            </div>
        </div>
    </div>
    </div>
    
    </div>
    <!-- ############################## VIEW DOCUMENTS ###################################### -->
    <div class='container' id="view-documents">
				<div id="view-documents-div" align="center">
					<img src="" id="bg" width="500" height="700" />
					<br>
					<a id='download_document_link' href=''><button type="button" id="download_document"
							style='font-size: 40;' class="btn btn-info form-control download_link download_link"><span
								class='iconify' data-icon='bx:download'></span>Download</button></a>
				</div>
				<br><br>
				<hr>
				<center><button type="button" id="return_to_student" style='font-size: 40;'
						class='btn btn-secondary'>RETURN</button></center>
			</div>   





    <!-- ##################################################################################################### -->
    
</body>

</html>