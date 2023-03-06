$(document).ready(function(){
	$('#student-transaction').hide();
	$('#payment-details').hide();

	$.ajax({
		type:'GET',
		url: '../controller/FinanceInfo.php',
		data:
		{
			type : 'STUD_INFO'
		},	
		dataType:'json',
		success: function(result)
		{
        	var financeRecord = "";
        	let count = 1;
        	var parent_arr = [];
			if(result.length != 0)
			{	
				$.each(result, function(key, value){
					var child_arr = []
					
					if(value.LVL_NAME == null)
					{
						value.LVL_NAME = "";
					}
					if(value.CRSE_NAME == null)
					{
						value.CRSE_NAME = "";
					}
					if(value.YRLVL_NAME == null)
					{
						value.YRLVL_NAME = "";
					}

					// financeRecord += 	"<tr  style='text-align: center;'>" + 
					// 						"<td>" + value.REG_ID		+ "</td>" + 
					// 						"<td>" + value.REG_DATE 	+ "</td>" + 
					// 						"<td>" + value.NAME 		+ "</td>" + 
					// 						"<td>" + value.STUDENT_TYPE + "</td>" + 
					// 						"<td>" + value.LVL_NAME   	+ "</td>" +
					// 						"<td>" + value.CRSE_NAME  	+ "</td>" +
					// 						"<td>" + value.YRLVL_NAME 	+ "</td>";

					let status = "";

					if(value.REG_STATUS == 2)
					{
						status = "<label class='btn btn-outline-secondary' style='font-size:13px;'> ESS VERIFIED</label>";
					}
					if(value.REG_STATUS == 3)
					{
						status = "<label class='btn btn-outline-warning' style='font-size:13px;'> FINANCE VERIFIED</label>";
					}
					if(value.REG_STATUS == 4)
					{
						status = "<label class='btn btn-success' style='font-size:13px;'> STUDENT ENROLLED</label>";
					}

					financeRecord +=		"<td>" + status + "</td>" +
											"<td><button type='button' id='PaymentTrend' name='PaymentTrend' class='btn btn-primary style='font-size: 13px;'>PAYMENT TREND</button></td>" +
										"</tr>";
					payment = "<button type='button' id='PaymentTrend' name='PaymentTrend' class='btn btn-primary style='font-size: 13px;' value='"+ value.REG_ID +"'>PAYMENT TREND</button>";
					child_arr.push(value.REG_ID, value.REG_DATE, value.NAME, value.STUDENT_TYPE, value.LVL_NAME, value.CRSE_NAME, value.YRLVL_NAME, status, payment);
					parent_arr.push(child_arr);
					count++;			

				});
				// $('#finance-records tr').remove();
				// $('#finance-records').append(financeRecord);
			}
			//child_arr.push(value.LVL_NAME, value.CRSE_NAME, value.REG_DATE, value.NAME);
			$(document).ready(function(){
				$('#finance-table').DataTable({
					data: parent_arr,
					columns: [
						{ title: '#' },
						{ title: 'TIMESTAMP' },
						{ title: 'STUDENT NAME' },
						{ title: 'STUDENT TYPE' },
						{ title: 'LEVEL' },
						{ title: 'GRADE LEVEL' },
						{ title: 'STRAND/PROGRAM' },
						{ title: 'STATUS' },
						{ title: 'ACTION' }
					],
					order: [[0, 'desc']],
					pageLength: 50,
					scrollY:        "500px",
					scrollX:        true,
					scrollCollapse: true,
				
				});	
			});	
	
			
		}
	});

	$(document).on("click", '#return', function(event) { 
		$('#finance-table_wrapper').show();
		$('#student-transaction').hide();
	});	

});