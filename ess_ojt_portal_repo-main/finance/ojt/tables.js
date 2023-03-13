$(document).on("click", '#PaymentTrend', function(event) { 
    $('#finance-table_filter > label > input[type=search]').val("");
    $('#finance-table_wrapper').hide();
    $('#student-transaction').show();
    var stud_reg_id = $(this).val();
    $.ajax({
        type:'GET',
		url: '../controller/FinanceInfo.php',
		data:
		{
			type : 'GET_PD',
            reg_id: stud_reg_id
		},	
		dataType:'json',
		success: function(result)
		{
        	let count = 1;
        	var parent_arr = [];
            if(result.length != 0)
			{	
				$.each(result, function(key, value){
                    var child_arr = []
                    action_btn = '<button type="button" id="btn"></button>';
                    child_arr.push(count,
                        value.PAYMENT_SUBMITTED_DATE,
                        value.TRANSACTION_TYPE,
                        value.BANK,
                        value.AMOUNT,
                        value.TRANSACTION_DATE,
                        value.REFERENCE_ID,
                        value.PAYMENT_STATUS,
                        action_btn);
                    parent_arr.push(child_arr);
                    count++;
                });
            }else{
				$('#student-transaction').append('<center><button type="button" id="btn" style="border: 2px;background: rgba(191,217,250,0.8);padding: 10px;font-weight: bold;border-radius: 10px;">GO BACK</button></center><br>');
                $(document).on("click", '#btn', function(event) { 
                    $('#finance-table_wrapper').show();
                    $('#student-transaction').hide();
                });
            }

            $(document).ready(function () {
                $('#regtable').DataTable({
                    pageLength: 10,
                    data: parent_arr,
                    columns: [
                        { title: '#' },
                        { title: 'DATE' },
                        { title: 'TRANSACTION' },
                        { title: 'BANK NAME' },
                        { title: 'AMOUNT' },
                        { title: 'TRANSACTION DATE' },
                        { title: 'TRANSACTION NO.' },
                        { title: 'PAYMENT STATUS' },
                        { title: 'ACTIONS' }
                    ],
                });
            })

        }
    });
    
});