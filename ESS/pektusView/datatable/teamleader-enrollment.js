$(document).ready(function () {
 
	$.ajax({
		type:'GET',
		url: './controller/test.php',
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
			console.log(result);
            $.ajax({
                type:'GET',
                url: './controller/test.php',
                data:
                {
                    type : 'USERS'
                },	
                dataType:'json',
                success: function(result)
                {
                    console.log(result)
            }
            });

            if(result.length != 0)
			{	
				$.each(result, function(key, value){
					var child_arr = [];
                    let = ess_staff_assigned = "";


                   // $createTable .= "<td style='text-align:center;' >";
        //     $createTable .= "<div class='dropdown'>";
        //         if($regitem['STATUS'] == 2)
        //         {   

        //             $createTable .= "<select id='user-list".$regitem['ID']."' name='user-list' class='form-control dropdown' disabled>";
        //             $createTable .= "<option value='0'>Unassigned</option>";

        //             foreach($fetchDatauser as $useritem)
        //             {
        //                 if ($regitem['ESS_ID'] == $useritem['ESS_ID'])
        //                 {
        //                     $createTable .= "<option value='".$useritem['ESS_ID'].",".$regitem['ID']."' selected>".$useritem['NAME']."</option>";
        //                 } 
        //                 else 
        //                 {
        //                     $createTable .= "<option value='".$useritem['ESS_ID'].",".$regitem['ID']."'>".$useritem['NAME']."</option>";
        //                 }
        //             }   
        //             $createTable .= "</select>";

        //         }
        //         else
        //         {
        //             $createTable .= "<select id='user-list".$regitem['ID']."' name='user-list' class='form-control dropdown'>";
        //             $createTable .= "<option value='0'>Unassigned</option>";

        //             foreach($fetchDatauser as $useritem)
        //             {
        //                 if ($regitem['ESS_ID'] == $useritem['ESS_ID'])
        //                 {
        //                     $createTable .= "<option value='".$useritem['ESS_ID'].",".$regitem['ID']."' selected>".$useritem['NAME']."</option>";
        //                 } 
        //                 else 
        //                 {
        //                     $createTable .= "<option value='".$useritem['ESS_ID'].",".$regitem['ID']."'>".$useritem['NAME']."</option>";
        //                 }
        //             }
        //         $createTable .= "</select>";
        //         }

        //     $createTable .= "</div'>";
        //     $createTable .= "</td>";

					child_arr.push(count, value.REG_DATE, value.NAME, value.LVL_NAME, value.YRLVL_NAME, value.STUD_TYPE, value.CRSE_NAME);
					student_arr.push(child_arr);
					count++;			
				});

                console.log(student_arr);
			}
            
            $(document).ready(function(){
				$('#regtable').DataTable({
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
					],
					order: [[0, 'desc']],
					pageLength: 10,
					scrollY:        "500px",
					//scrollX:        true,
					scrollCollapse: true,
				
				});	
			});	
			
		},
		error: function (request, status, error) {
			console.log(request.responseText);
		}
	});
    
});