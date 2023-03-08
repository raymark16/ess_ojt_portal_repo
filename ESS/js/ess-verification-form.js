var registration = 0;


$(document).ready(function () {
    $('#ess-verification').hide();

    var student_arr = [];
    $('#regtable').DataTable({
        ajax: {
            type: 'GET',
            url: './controller/test.php',
            cache: false,
            data:
            {
                type: 'INFO'
            },
            dataType: 'json',
            success: function (result) {

                let count = 1;
                var student_arr = [];

                if (result.length != 0) {
                    $.each(result, function (key, value) {

                        var child_arr = [];
                        actions_btn = "<button type='button' class='btn btn-primary' id='viewProfile' value='" + value.ID + "'>VIEW PROFILE</button></a>";
                        status_column = "";
                        remarks_column = "";
                        //################################# ESS STAFF ASSIGNED ###################################################
                        // if (value.STATUS == 2) {
                        //     select_btn = "<select id='user-list" + value.ID + "' name='user-list' class='form-control dropdown' disabled>";
                        //     select_btn += "<option value='0'>Unassigned</option>";
                        //     $.ajax({
                        //         type: 'GET',
                        //         url: './controller/test.php',
                        //         data:
                        //         {
                        //             type: 'ESS-STAFF',

                        //         },
                        //         dataType: 'json',
                        //         success: function (result) {
                        //             //console.log(result);
                        //             // ess_staff_assigned.push(result);
                        //             $.each(result, function (key, value1) {
                        //                 console.log(value1.ESS_ID);
                        //                 // if (value.ESS_ID == value1.ESS_ID) {
                        //                 //     select_btn += "<option value='"+value1.ESS_ID+","+value.ID+"' selected>"+value1.NAME+"</option>";
                        //                 // }
                        //                 // else {
                        //                 //     select_btn += "<option value='"+value1.ESS_ID+","+value.ID+"'>"+value1.NAME+"</option>";
                        //                 // }
                        //             });

                        //         },
                        //         error: function (request, status, error) {
                        //             console.log(request.responseText);
                        //         }
                        //     });
                        //     select_btn += "</select>";
                        // } else {
                        //     select_btn = "<select id='user-list" + value.ID + "' name='user-list' class='form-control dropdown' >";
                        //     select_btn += "<option value='0'>Unassigned</option>";
                        //     $.ajax({
                        //         type: 'GET',
                        //         url: './controller/test.php',
                        //         data:
                        //         {
                        //             type: 'ESS-STAFF',

                        //         },
                        //         dataType: 'json',
                        //         success: function (result) {
                        //             $.each(result, function (key, value2) {

                        //                 if (value.ESS_ID == value2.ESS_ID) {
                        //                     select_btn += "<option value='"+value2.ESS_ID+","+value.ID+"' selected>"+value2.NAME+"</option>";
                        //                 }
                        //                 else {
                        //                     select_btn += "<option value='"+value2.ESS_ID+","+value.ID+"'>"+value2.NAME+"</option>";
                        //                 }
                        //             });

                        //         },
                        //         error: function (request, status, error) {
                        //             console.log(request.responseText);
                        //         }
                        //     });
                        //     select_btn += "</select>";
                        // };

                        //################################# STATUS COLUMN ###################################################
                        if(value.STATUS == null)
                        {
                            status_column += "<td style='text-align:center; ' >";
                            status_column += "<label type='label' class='btn btn-outline-secondary' disabled>TO BE VERIFIED</label>";
                            status_column += "</td>";
                        }


                        if(value.STATUS == 0)
                        {   
                            status_column += "<td style='text-align:center; ' >";
                            status_column += "<label type='label' class='btn btn-outline-secondary' disabled>TO BE VERIFIED</label>";
                            status_column += "</td>";

                        }
                        if(value.STATUS == 1)
                        {
                            status_column += "<td style='text-align:center;' >";
                            status_column += "<label type='label' class='btn btn-outline-primary ' disabled>TO BE PROCESSED</label>";
                            status_column += "</td>";

                        }
                        else if(value.STATUS == 2)
                        {
                            status_column += "<td style='text-align:center;' >";
                            status_column += "<label type='label' class='btn btn-success' disabled>STUDENT PROCESSED</label>";
                            status_column += "</td>";

                        }        
                        
                        //################################# REMARKS ###################################################
                        if(value.STATUS == 1)
                        {
                            remarks_column += "<td style='text-align:center;' >";
                            remarks_column += "<button type='button' id='submit_process_student' class='btn btn-warning' value='"+ value.ID +"'>PROCESS STUDENT</button></a>";
                            remarks_column += "</td>";
                        }
                        if(value.STATUS == 2)
                        {
                            remarks_column += "<td style='text-align:center;' >";
                            remarks_column += "<button type='button' class='btn btn-outline-success' disabled>TRANSFERRED TO FINANCE</button";
                            remarks_column += "</td>";
                        }
                        //################################# PUSHING OF DATA ###################################################
                        child_arr.push(count,
                            value.REG_DATE,
                            value.NAME,
                            value.LVL_NAME,
                            value.YRLVL_NAME,
                            value.STUD_TYPE,
                            value.CRSE_NAME,
                            // select_btn,
                            status_column, 
                            actions_btn,
                            remarks_column,
                        );
                        student_arr.push(child_arr);
                        count++;
                    });
                    $('#regtable').DataTable().clear().rows.add(student_arr).draw();
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        },
        data: student_arr,
        columns: [
            { title: '#' },
            { title: 'REGISTRATION DATE' },
            { title: 'STUDENT NAME' },
            { title: 'ACADEMIC LEVEL' },
            { title: 'GRADE/YEAR LEVEL' },
            { title: 'STUDENT TYPE' },
            { title: 'COURSE/STRAND' },
            //{ title: 'ESS STAFF ASSIGNED' },
            { title: 'STATUS' },
            { title: 'ACTIONS' },
            { title: 'REMARKS' }
        ],
        order: [[9, 'desc']],
        pageLength: 10,
        scrollY: "500px",
        //scrollX:        true,
        scrollCollapse: true,
    });

    $(document).on("click", '#viewProfile', function () {
        console.log('wew1');
        $('#ess-verification').show();

        $('#teamleader-enrollment-registration-process').hide();

        registration = $(this).val();
        console.log(registration);
        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: './controller/test.php',
                data:
                {
                    type: 'STUD_DETAILS',
                    reg_id: registration
                },
                dataType: 'json',
                success: function (result) {
                    console.log(result);

                    var option_for_ESC_or_SHS = "";
                   
                    $('#academiclevel-list').val(result.schlacadlvl_code);
                    $('#academicyearlevel-list').val(result.schlacadyrlvl_name);
                    $('#student_type').val(result.student_type + " " + result.studium_type);
                    $('#academiccourse-list').val(() => {
                        if (result.schlacadcrse_name != null) {
                            return result.schlacadcrse_name;
                        }
                        else {
                            return "";
                        }
                    });
                    $('#last_school_sector').val(() => {
                        if (result.schlacadcrse_name != null) {
                            return result.last_school_sector;
                        }
                        else {
                            return "";
                        }
                    });
                    $('#lastname').val(result.schlenrollprereg_lname);
                    $('#firstname').val(result.schlenrollprereg_fname);
                    $('#middlename').val(result.schlenrollprereg_mname);
                    $('#suffix').val(result.schlenrollprereg_suffix);
                    $('#age').val(result.schlenrollprereg_age);
                    $('#gender-list').val(result.schlenrollprereg_gender);
                    $('#birthdate').val(result.schlenrollprereg_bdate);
                    $('#birthplace').val(result.schlenrollprereg_bplace);
                    $('#nationality').val(result.schlenrollprereg_nationality);
                    $('#religion').val(result.schlenrollprereg_religion);
                    $('#mothertongue').val(result.schlenrollprereg_mothertongue);
                    $('#civilstatus-list').val(result.schlenrollprereg_civilstatus);
                    $('#numberofsiblings').val(result.schlenrollprereg_noofsiblings);
                    $('#mobilenumber').val(result.schlenrollprereg_mobileno);
                    $('#telephone').val(result.schlenrollprereg_telno);
                    $('#emailaddress').val(result.schlenrollprereg_emailadd);
                    $('#present-streetaddress').val(result.schlenrollprereg_present_streetadd);
                    $('#present-province-list').val(result.present_province_name);
                    $('#present-municipality-list').val(result.present_municipality_name);
                    $('#present-barangay-list').val(result.present_barangay_name);
                    $('#present-zipcode').val(result.schlenrollprereg_present_zipcode);
                    $('#permanent-streetaddress').val(result.schlenrollprereg_permanent_streetadd);
                    $('#permanent-province-list').val(result.permanent_province_name);
                    $('#permanent-municipality-list').val(result.permanent_municipality_name);
                    $('#permanent-barangay-list').val(result.permanent_barangay_name);
                    $('#permanent-zipcode').val(result.schlenrollprereg_permanent_zipcode);
                    $('#permanent-zipcode').val(result.schlenrollprereg_permanent_zipcode);

                    $('#submit').val(registration);
                    if (result.schoolacadyearlevel_id >= 10 && result.schoolacadyearlevel_id <= 14) {
                        option_for_ESC_or_SHS += "<p>ESC or SHS</p>";
                        option_for_ESC_or_SHS += '<select name="esc_or_shs" id="esc_or_shs" class="form-control" required>';
                        
                        if (result.schoolacadyearlevel_id <= 12) {
                            option_for_ESC_or_SHS += '<option value="WITHOUT ESC">WITHOUT ESC</option>';
                            option_for_ESC_or_SHS += '<option value="WITH ESC">WITH ESC</option>';
                        } else if(result.schoolacadyearlevel_id == 13) {
                            option_for_ESC_or_SHS += '<option value="WITHOUT ESC CERT OR SHS VOUCHER">WITHOUT ESC CERT OR SHS VOUCHER</option>';
                            option_for_ESC_or_SHS += '<option value="WITH ESC CERT OR SHS VOUCHER">   WITH ESC CERT OR SHS VOUCHER</option>';
                        } else if(result.schoolacadyearlevel_id == 14) {
                            option_for_ESC_or_SHS += '<option value="WITHOUT SHS VOUCHER">WITHOUT SHS VOUCHER</option>';
                            option_for_ESC_or_SHS += '<option value="WITH SHS VOUCHER PUBLIC">WITH SHS VOUCHER</option>';
                            option_for_ESC_or_SHS += '<option value="WITH SHS VOUCHER PRIVATE">WITH SHS VOUCHER PRIVATE</option>';
                        }
                        option_for_ESC_or_SHS += '</select>';
                    }
                    $('#ESCSHS').append(option_for_ESC_or_SHS);
                   
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        })

    });
    var option_selected_for_esc_or_shs = "";
    $(document).on("change", '#esc_or_shs', function () {
        option_selected_for_esc_or_shs = $(this).val();
    });
    $(document).on("click", '#return', function () {
        $('#ess-verification').hide();
        $('#teamleader-enrollment-registration-process').show();
        $("#regtable").DataTable().ajax.reload();
        $('#ESCSHS').empty();
    });

    $(document).on('click', '#submit', function () {
        $('#ESCSHS').empty();
        registration = $(this).val();
        var sinok;
        if(option_selected_for_esc_or_shs != "") {
            sinok = option_selected_for_esc_or_shs;
        } else {
            sinok = null;
        }

        $.ajax({
            type: 'POST',
            url: './controller/ess-post.php',
            data:
            {
                type: 'POST_VERIFY',
                reg_id: registration,
                esc_or_shs_selected: sinok,
            },
            dataType: 'json',
            success: function (result) {
                console.log(result);
                
            },
            error: function (request, status, error) {
            	console.log(request.responseText);
            }
        });
        $('#ess-verification').hide();
        alert("Student is Verified Successfully");
        $('#teamleader-enrollment-registration-process').show();
        $("#regtable").DataTable().ajax.reload();
    });


    $(document).on('click', '#submit_process_student', function () {
        registration = $(this).val();
        console.log(registration);
        $.ajax({
            type: 'POST',
            url: './controller/ess-post.php',
            data:
            {
                type: 'POST_PROCESS_STUDENT',
                reg_id: registration,

            },
            dataType: 'json',
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, error) {
            	console.log(request.responseText);
            }
        });
        alert("Student is Verified Successfully");
        $("#regtable").DataTable().ajax.reload();
    });

})
