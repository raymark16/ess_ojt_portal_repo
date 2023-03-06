var registration = 0;


$(document).ready(function(){
    $('#ess-verification').hide();
    $.ajax({
                type: 'GET',
                url: './controller/test.php',
                data:
                {
                    type: 'ESS-STAFF',

                },
                dataType: 'json',
                success: function (result) {
                    console.log(result)
                    
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
    var student_arr = [];
    $('#regtable').DataTable({
        ajax:{
            type:'GET',
            url: './controller/test.php',
            cache: false,
            data:
            {
                type : 'INFO'
            },	
            dataType:'json',
            success: function(result)
            {
                var studentRecord = "";
                let count = 1;
                var student_arr = [];
            
                if(result.length != 0)
                {	
                    $.each(result, function(key, value){
                        var child_arr = [];
                        let = ess_staff_assigned = "";
                        actions_btn = "<button type='button' class='btn btn-primary' id='viewProfile' value='" + value.ID + "'>VIEW PROFILE</button></a>";

                        child_arr.push(count,
                            value.REG_DATE,
                            value.NAME,
                            value.LVL_NAME,
                            value.YRLVL_NAME,
                            value.STUD_TYPE,
                            value.CRSE_NAME,
                            actions_btn);
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
            { title: 'ACTIONS' },
            //{ title: 'ESS STAFF ASSIGNED' },
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            scrollY:        "500px",
            //scrollX:        true,
            scrollCollapse: true,
    });
    
        $(document).on("click", '#viewProfile', function () {
            console.log('wew1');
           $('#ess-verification').show();
           $('#teamleader-enrollment-registration-process').hide();

            registration = $(this).val();
            console.log(registration);
            $(document).ready(function() {
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
                        $student_type_studium_type = "";
                       $('#academiclevel-list').val(result.schlacadlvl_code);
                       $('#academicyearlevel-list').val(result.schlacadyrlvl_name);
                       $('#student_type').val(result.student_type + " " + result.studium_type);
                       $('#academiccourse-list').val(()=>{
                        if(result.schlacadcrse_name.length != 0) {
                            return result.schlacadcrse_name;
                        }
                        else {
                            return "";
                        }
                    });
                       $('#last_school_sector').val(()=>{
                        if(result.schlacadcrse_name.length != 0) {
                            return result.last_school_sector;
                        }
                        else {
                            return "";
                        }
                    });
                    $('#lastname').val(result.schlenrollprereg_lname
                        );
                    $('#firstname').val(result.schlenrollprereg_fname
                        );
                    $('#middlename').val(result.schlenrollprereg_mname

                        );
                    $('#suffix').val(result.schlenrollprereg_suffix 
                        );
                    $('#age').val(result.schlenrollprereg_age 
                        );
                    $('#gender-list').val(result.schlenrollprereg_gender 
                        );
                    $('#birthdate').val(result.schlenrollprereg_bdate
                        );
                    $('#birthplace').val(result.schlenrollprereg_bplace
                        );
                    $('#nationality').val(result.schlenrollprereg_nationality
                        );
                    $('#religion').val(result.schlenrollprereg_religion
                        );
                    $('#mothertongue').val(result.schlenrollprereg_mothertongue
                        );
                    $('#civilstatus-list').val(result.schlenrollprereg_civilstatus
                        );
                    $('#numberofsiblings').val(result.schlenrollprereg_noofsiblings
                        );
                    $('#mobilenumber').val(result.schlenrollprereg_mobileno
                        );
                    $('#telephone').val(result.schlenrollprereg_telno
                        );
                    $('#emailaddress').val(result.schlenrollprereg_emailadd
                        );
                    $('#present-streetaddress').val(result.schlenrollprereg_present_streetadd
                        );
                    $('#present-province-list').val(result.present_province_name
                        ); 
                    $('#present-municipality-list').val(result.present_municipality_name
                        );
                    $('#present-barangay-list').val(result.present_barangay_name
                        );
                    $('#present-zipcode').val(result.schlenrollprereg_present_zipcode
                        );
                    $('#permanent-streetaddress').val(result.schlenrollprereg_permanent_streetadd
                        );
                    $('#permanent-province-list').val(result.permanent_province_name
                        );
                    $('#permanent-municipality-list').val(result.permanent_municipality_name
                        );
                    $('#permanent-barangay-list').val(result.permanent_barangay_name
                        );
                    $('#permanent-zipcode').val(result.schlenrollprereg_permanent_zipcode
                        );
                        $('#permanent-zipcode').val(result.schlenrollprereg_permanent_zipcode
                            );                           
                    },  
                    
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                });
            })
            
        }); 

        $(document).on("click", '#return', function () {
            console.log('rer')
            $('#ess-verification').hide();
            $('#teamleader-enrollment-registration-process').show();
            $("#regtable").DataTable().ajax.reload();
        });
        

})
