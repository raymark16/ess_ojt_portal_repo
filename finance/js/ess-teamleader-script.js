$(document).ready(function(){

	alert('START');

	// $.ajax({
	// 	type:'GET',
	// 	url: '../controller/FinanceInfo.php',
	// 	data:
	// 	{
	// 		type : 'STUD_INFO'
	// 	},	
	// 	dataType:'json',
	// 	success: function(result)
	// 	{
    //     	console.log(result);

    //     	var financeRecord = "";
    //     	let count = 1

    //     	console.log(result.length);
			

	// 		if(result.length != 0)
	// 		{	
	// 			$.each(result, function(key, value){

	// 				financeRecord += 	"<tr  style='text-align: center;'>" + 
	// 										"<td>" + count++ 			+ "</td>" + 
	// 										"<td>" + value.REG_DATE 	+ "</td>" + 
	// 										"<td>" + value.NAME 		+ "</td>" + 
	// 										"<td>" + value.STUDENT_TYPE + "</td>" + 
	// 										"<td>" + value.LVL_NAME   	+ "</td>" +
	// 										"<td>" + value.CRSE_NAME  	+ "</td>" +
	// 										"<td>" + value.YRLVL_NAME 	+ "</td>" +
	// 										"<td>" + value.REG_STATUS 	+ "</td>" +
	// 									"</tr>";

	// 			});
	// 			alert(financeRecord);
	// 			$('#finance-records tr').remove();
	// 			$('#finance-records').append(financeRecord);

	// 		}



	// 	}
	// });

});