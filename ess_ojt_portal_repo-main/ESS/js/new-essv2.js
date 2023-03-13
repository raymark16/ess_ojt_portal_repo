$(document).ready(function () {
    $('#ess-verification').hide();
    $('#view-documents').hide();
    var student_arr = [];
    var count = 1;
    var registration = 0;
    async function main() {


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
                success: async function (result) {
                    try {
                        var get_ess_staff = await getEssStaff();
                    } catch (error) {
                        console.log(error);
                    }
                    if (result.length != 0) {
                        $.each(result, function (key, value) {

                            var child_arr = [];
                            actions_btn = "<button type='button' class='btn btn-primary' id='viewProfile' value='" + value.ID + "'>VIEW PROFILE</button></a>";
                            status_column = "";
                            remarks_column = "";
                            // ################################# ESS STAFF ASSIGNED ###################################################
                            if (value.STATUS == 2) {
                                select_btn = "<select id='user-list' name='user-list' class='form-control dropdown' value='" + value.ID + "' placeholder='" + value.ID + "' disabled>";
                                select_btn += "<option value='0'>Unassigned</option>";
                                get_ess_staff.forEach(value1 => {
                                    if (value.ESS_ID == value1.ESS_ID) {
                                        select_btn += "<option value='" + value1.ESS_ID + "' selected>" + value1.NAME + "</option>";
                                    }
                                    else {
                                        select_btn += "<option value='" + value1.ESS_ID + "'>" + value1.NAME + "</option>";
                                    };
                                });
                                select_btn += "</select>";
                            } else {
                                select_btn = "<select id='user-list' name='user-list' class='form-control dropdown' value='" + value.ID + "' placeholder='" + value.ID + "' >";
                                select_btn += "<option value='0'>Unassigned</option>";
                                get_ess_staff.forEach(value2 => {
                                    if (value.ESS_ID == value2.ESS_ID) {
                                        select_btn += "<option value='" + value2.ESS_ID + "' selected>" + value2.NAME + "</option>";
                                    }
                                    else {
                                        select_btn += "<option value='" + value2.ESS_ID + "'>" + value2.NAME + "</option>";
                                    };
                                });
                                select_btn += "</select>";
                            };
                            //###################################################################################################

                            //################################# STATUS COLUMN ###################################################
                            if (value.STATUS == null) {
                                status_column += "<td style='text-align:center; ' >";
                                status_column += "<label type='label' class='btn btn-outline-secondary' disabled>TO BE VERIFIED</label>";
                                status_column += "</td>";
                            }


                            if (value.STATUS == 0) {
                                status_column += "<td style='text-align:center; ' >";
                                status_column += "<label type='label' class='btn btn-outline-secondary' disabled>TO BE VERIFIED</label>";
                                status_column += "</td>";

                            }
                            if (value.STATUS == 1) {
                                status_column += "<td style='text-align:center;' >";
                                status_column += "<label type='label' class='btn btn-outline-primary ' disabled>TO BE PROCESSED</label>";
                                status_column += "</td>";

                            }
                            else if (value.STATUS == 2) {
                                status_column += "<td style='text-align:center;' >";
                                status_column += "<label type='label' class='btn btn-success' disabled>STUDENT PROCESSED</label>";
                                status_column += "</td>";

                            }

                            //################################# REMARKS ###################################################
                            if (value.STATUS == 1) {
                                remarks_column += "<td style='text-align:center;' >";
                                remarks_column += "<button type='button' id='submit_process_student' class='btn btn-warning' value='" + value.ID + "'>PROCESS STUDENT</button></a>";
                                remarks_column += "</td>";
                            }
                            if (value.STATUS == 2) {
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
                                select_btn,
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
                { title: 'ESS STAFF ASSIGNED' },
                { title: 'STATUS' },
                { title: 'ACTIONS' },
                { title: 'REMARKS' }
            ],
            order: [[9, 'desc']],
            pageLength: 100,
            scrollY: "700px",
            //scrollX:        true,
            scrollCollapse: true,
        });

        var option_selected_for_esc_or_shs = "";
        $(document).on("click", '#viewProfile', async function () {
            $('#ess-verification').show();
            $('#teamleader-enrollment-registration-process').hide();
            registration = $(this).val();

            console.log(registration);
            try {
                var get_stud_details = await getStudDetails(registration);
            } catch (error) {
                console.log(error)
            }
            $('#academiclevel-list').val(get_stud_details.schlacadlvl_code);
            $('#academicyearlevel-list').val(get_stud_details.schlacadyrlvl_name);
            $('#student_type').val(get_stud_details.student_type + " " + get_stud_details.studium_type);
            $('#academiccourse-list').val(() => {
                if (get_stud_details.schlacadcrse_name != null) {
                    return get_stud_details.schlacadcrse_name;
                }
                else {
                    return "";
                }
            });
            $('#last_school_sector').val(() => {
                if (get_stud_details.schlacadcrse_name != null) {
                    return get_stud_details.last_school_sector;
                }
                else {
                    return "";
                }
            });
            $('#lastname').val(get_stud_details.schlenrollprereg_lname);
            $('#firstname').val(get_stud_details.schlenrollprereg_fname);
            $('#middlename').val(get_stud_details.schlenrollprereg_mname);
            $('#suffix').val(get_stud_details.schlenrollprereg_suffix);
            $('#age').val(get_stud_details.schlenrollprereg_age);
            $('#gender-list').val(get_stud_details.schlenrollprereg_gender);
            $('#birthdate').val(get_stud_details.schlenrollprereg_bdate);
            $('#birthplace').val(get_stud_details.schlenrollprereg_bplace);
            $('#nationality').val(get_stud_details.schlenrollprereg_nationality);
            $('#religion').val(get_stud_details.schlenrollprereg_religion);
            $('#mothertongue').val(get_stud_details.schlenrollprereg_mothertongue);
            $('#civilstatus-list').val(get_stud_details.schlenrollprereg_civilstatus);
            $('#numberofsiblings').val(get_stud_details.schlenrollprereg_noofsiblings);
            $('#mobilenumber').val(get_stud_details.schlenrollprereg_mobileno);
            $('#telephone').val(get_stud_details.schlenrollprereg_telno);
            $('#emailaddress').val(get_stud_details.schlenrollprereg_emailadd);
            $('#present-streetaddress').val(get_stud_details.schlenrollprereg_present_streetadd);
            $('#present-province-list').val(get_stud_details.present_province_name);
            $('#present-municipality-list').val(get_stud_details.present_municipality_name);
            $('#present-barangay-list').val(get_stud_details.present_barangay_name);
            $('#present-zipcode').val(get_stud_details.schlenrollprereg_present_zipcode);
            $('#permanent-streetaddress').val(get_stud_details.schlenrollprereg_permanent_streetadd);
            $('#permanent-province-list').val(get_stud_details.permanent_province_name);
            $('#permanent-municipality-list').val(get_stud_details.permanent_municipality_name);
            $('#permanent-barangay-list').val(get_stud_details.permanent_barangay_name);
            $('#permanent-zipcode').val(get_stud_details.schlenrollprereg_permanent_zipcode);
            $('#permanent-zipcode').val(get_stud_details.schlenrollprereg_permanent_zipcode);

            var student_uploaded_documents = "";
            try {
                var get_view_document = await getViewDocument(registration);
            } catch (error) {
                console.log(error)
            }
            get_view_document.forEach(value => {
                student_uploaded_documents += "<button type='button' id='view_document' value='" + value.document_id + "' style='font-size: 20; margin: 0 10px 10px 0' class='btn btn-info form-control download_link download_link'><span class='iconify' data-icon='bx:download'></span>View Documents</button>";
            });
            $('#view_document_section').html(student_uploaded_documents);

            var option_for_ESC_or_SHS = "";
            $('#submit').val(registration);
            if (get_stud_details.schoolacadyearlevel_id >= 10 && get_stud_details.schoolacadyearlevel_id <= 14) {
                option_for_ESC_or_SHS += "<p>ESC or SHS</p>";
                option_for_ESC_or_SHS += '<select name="esc_or_shs" id="esc_or_shs" class="form-control" required>';

                if (get_stud_details.schoolacadyearlevel_id <= 12) {
                    option_for_ESC_or_SHS += '<option value="WITHOUT ESC">WITHOUT ESC</option>';
                    option_for_ESC_or_SHS += '<option value="WITH ESC">WITH ESC</option>';
                } else if (get_stud_details.schoolacadyearlevel_id == 13) {
                    option_for_ESC_or_SHS += '<option value="WITHOUT ESC CERT OR SHS VOUCHER">WITHOUT ESC CERT OR SHS VOUCHER</option>';
                    option_for_ESC_or_SHS += '<option value="WITH ESC CERT OR SHS VOUCHER">   WITH ESC CERT OR SHS VOUCHER</option>';
                } else if (get_stud_details.schoolacadyearlevel_id == 14) {
                    option_for_ESC_or_SHS += '<option value="WITHOUT SHS VOUCHER">WITHOUT SHS VOUCHER</option>';
                    option_for_ESC_or_SHS += '<option value="WITH SHS VOUCHER PUBLIC">WITH SHS VOUCHER</option>';
                    option_for_ESC_or_SHS += '<option value="WITH SHS VOUCHER PRIVATE">WITH SHS VOUCHER PRIVATE</option>';
                }
                option_for_ESC_or_SHS += '</select>';
            }
            $('#ESCSHS').html(option_for_ESC_or_SHS);
            option_selected_for_esc_or_shs = $('#esc_or_shs').val();
        });



        $(document).on("change", '#esc_or_shs', function () {
            option_selected_for_esc_or_shs = $(this).val();
        });

        $(document).on("click", '#return', function () {
            $('#ess-verification').hide();
            $('#teamleader-enrollment-registration-process').show();
            $("#regtable").DataTable().ajax.reload();
        });

        // ############################ SUBMIT FOR VIEW PROFILE ##########################################
        $(document).on('click', '#submit', function () {
            registration = $(this).val();
            var sinok;
            if (option_selected_for_esc_or_shs != "") {
                sinok = option_selected_for_esc_or_shs;
            } else {
                sinok = "";
            }
            $.ajax({
                type: 'POST',
                url: './controller/ess-post.php',
                data:
                {
                    type: 'POST_VERIFY',
                    reg_id: registration,
                    esc_or_shs_selected: sinok
                },
                dataType: 'json',
                success: function (result) {

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
        // #########################################################################################
        // ############################ ON CHANGE OF SELECT ESS ASSIGN COLUMN ##########################################
        $(document).on('change', '#user-list', function () {

            id_of_user_list = $(this).val();
            var reg_id_of_student = $(this).attr('placeholder');
            $.ajax({
                type: 'POST',
                url: './controller/ess-post.php',
                data:
                {
                    type: 'POST_ESS_STAFF_ASSIGNED',
                    id_of_user_list: id_of_user_list,
                    reg_id_of_student: reg_id_of_student
                },
                dataType: 'json',
                success: function () {

                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });
        // #########################################################################################
        // ############################ PROCESS STUDENT ##########################################
        $(document).on('click', '#submit_process_student', function () {
            registration = $(this).val();

            $.ajax({
                type: 'POST',
                url: './controller/ess-post.php',
                dataType: 'json',
                data:
                {
                    type: 'POST_PROCESS_STUDENT',
                    reg_id: registration
                },
                success: function (result) {
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
            alert("Student is Processed Successfully");
            $("#regtable").DataTable().ajax.reload();
        });
        // #########################################################################################
        // ################################### VIEW DOCUMENT ##########################################

        $(document).on("click", '#view_document', function () {
            $('#ess-verification').hide();
            $('#view-documents').show();
            var id = $(this).val();

            $.ajax({
                type: 'GET',
                url: './controller/test.php',
                async: false,
                data:
                {
                    type: 'VIEW_SPECIFIC_DOCUMENT',
                    view_document_id: id,
                },
                dataType: 'json',
                success: function (result) {
                    $("#bg").attr('src', result.document_location);
                    $("#download_document_link").attr('href', './controller/DownloadController.php?id=' + id);
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });

        // #########################################################################################
        $(document).on("click", '#return_to_student', function () {
            $('#view-documents').hide();
            $('#ess-verification').show();
        });
    }
    main()
})

function getEssStaff() {
    return $.ajax({
        type: 'GET',
        url: './controller/test.php',
        dataType: 'json',
        data:
        {
            type: 'ESS-STAFF',

        }
    })
}
function getStudDetails(registration) {
    return $.ajax({
        type: 'GET',
        url: './controller/test.php',
        dataType: 'json',
        data:
        {
            type: 'STUD_DETAILS',
            reg_id: registration
        },

    })
}

function getViewDocument(registration) {
    return $.ajax({
        type: 'GET',
        url: './controller/test.php',
        dataType: 'json',
        data:
        {
            type: 'VIEW_DOCUMENT',
            reg_id: registration,
        },
    })
}



