var stud_reg_id = 0;
var remarks = '';
var id = 0;

function GetPaymentCount(id) {
	$.ajax({
		async: false,
		type: 'GET',
		url: '../controller/FinanceInfo.php',
		data:
		{
			type: 'GET_PAYMENTS',
			reg_id: id,
		},
		dataType: 'json',
		success: function (result) {

			// console.log(result['COUNT'])
			// console.log('')
			return result['COUNT'];
		},
		error: function (request, status, error) {
			console.log(request.responseText);
		}
	});
}

function GetVerifiedPaymentCount(id) {
	$.ajax({
		async: false,
		type: 'GET',
		url: '../controller/FinanceInfo.php',
		data:
		{
			type: 'GET_VERIFIED_PAYMENTS',
			reg_id: id,
		},
		dataType: 'json',
		success: function (result) {

			// console.log(result['COUNT'])
			// console.log('')
			return result['COUNT'];
		},
		error: function (request, status, error) {
			console.log(request.responseText);
		}
	});
}

function FinanceLandingPage() {
	$.ajax({
		async: false,
		type: 'GET',
		url: '../controller/FinanceInfo.php',
		data:
		{
			type: 'STUD_INFO'
		},
		dataType: 'json',
		success: function (result) {
			var financeRecord = "";
			let count = 1;
			var parent_arr = [];
			if (result.length != 0) {
				$.each(result, function (key, value) {
					var child_arr = []
					var payments_verified = '';

					if (value.LVL_NAME == null) {
						value.LVL_NAME = "";
					}
					if (value.CRSE_NAME == null) {
						value.CRSE_NAME = "";
					}
					if (value.YRLVL_NAME == null) {
						value.YRLVL_NAME = "";
					}

					// financeRecord += 	"<tr  style='text-align: center;'>" + 
					// 						"<td>" + count++ 			+ "</td>" + 
					// 						"<td>" + value.REG_DATE 	+ "</td>" + 
					// 						"<td>" + value.NAME 		+ "</td>" + 
					// 						"<td>" + value.STUDENT_TYPE + "</td>" + 
					// 						"<td>" + value.LVL_NAME   	+ "</td>" +
					// 						"<td>" + value.CRSE_NAME  	+ "</td>" +
					// 						"<td>" + value.YRLVL_NAME 	+ "</td>";

					let status = "";

					if (value.REG_STATUS == 2) {
						status = "<label class='btn btn-outline-secondary' style='font-size:13px;' disabled>ESS VERIFIED</label>";
					}
					if (value.REG_STATUS == 3) {
						status = "<label class='btn btn-warning' style='font-size:13px;' disabled>STUDENT PROCESSED</label>";
					}
					if (value.REG_STATUS == 4) {
						status = "<label class='btn btn-outline-success' style='font-size:13px;' disabled>STUDENT ENROLLED</label>";
					}
					// var payments_count = GetPaymentCount(value.REG_ID);
					// // console.log(value.REG_ID)
					// var verified_payments = GetVerifiedPaymentCount(value.REG_ID);
					// if (payments_count == 0) {

					// }
					// else if (payments_count == verified_payments) {
					// 	payments_verified = "<label type='label' class='btn btn-outline-success' disabled style='font-size: 13px;'> All payments are verified </label>";
					// }
					// else {
					// 	payments_verified = "<label type='label' class='btn btn-outline-danger' disabled style='font-size: 13px;' >" + payments_count + " payment verified out of " + verified_payments + "</label>";
					// }
					// financeRecord +=		"<td>" + status + "</td>" +
					// 						"<td><button type='button' id='PaymentTrend' name='PaymentTrend' class='btn btn-primary style='font-size: 13px;'>PAYMENT TREND</button></td>" +
					// 					"</tr>";
					payment = "<button type='button' id='PaymentTrend' name='PaymentTrend' class='btn btn-primary PaymentTrend' style='font-size: 13px;' value='" + value.REG_ID + "'>PAYMENT TREND</button>";
					child_arr.push(value.REG_ID, value.REG_DATE, value.NAME, value.STUDENT_TYPE, value.LVL_NAME, value.CRSE_NAME, value.YRLVL_NAME, status, payments_verified, payment);
					parent_arr.push(child_arr);
					count++;
				});
				// $('#finance-records tr').remove();
				// $('#finance-records').append(financeRecord);
			}
			//child_arr.push(value.LVL_NAME, value.CRSE_NAME, value.REG_DATE, value.NAME);
			$(document).ready(function () {
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
						{ title: 'PAYMENT VERIFIED' },
						{ title: 'ACTION' }
					],
					// order: [[0, 'desc']],
					pageLength: 10,
					scrollY: "500px",
					scrollX: true,
					scrollCollapse: true,

				});
			});
		},
		error: function (request, status, error) {
			console.log(request.responseText);
		}
	});
}

$(document).ready(function () {
	$('#student-transaction').hide();
	$('#payment-details').hide();
	$('#view-documents').hide();

	FinanceLandingPage();

	$(document).on("click", '#return', function (event) {
		$('#finance-table_wrapper').show();
		$('#student-transaction').hide();
		$('#payment-details').hide();
		stud_reg_id = 0;
		$('#regtable').DataTable().clear().draw();
		$("#regtable").DataTable().ajax.reload();
		$('#finance-table').DataTable().destroy();
		FinanceLandingPage();
	});

	var parent_arr = [];
	$('#regtable').DataTable({
		"autoWidth": false,
		ajax: {
			type: 'GET',
			url: '../controller/FinanceInfo.php',
			cache: false,
			data: function (d) {
				d.type = 'GET_PD';
				d.reg_id = stud_reg_id;
			},
			dataType: 'json',
			success: function (result) {
				parent_arr = [];
				let count = 1;

				if (result.length > 0) {
					$.each(result, function (key, value) {
						var child_arr = []
						action_btn = "<button type='button' id='viewDetails' name='viewDetails' class='btn btn-primary viewDetails' style='font-size: 13px;' value='" + value.RECEIPT + "'>VIEW PAYMENT FORM</button>";
						if (value.PAYMENT_STATUS == 1) {
							payment_label = "<label type='label' class='text-success' disabled>Payment Verified</label>";
						} else {
							payment_label = "<label type='label' class='text-danger' disabled>Not Verified</label>";
						}

						if (value.payment_remarks == 'tuition') {
							switch (parseInt(value.schlenrollprereg_verification)) {
								case 2:
									action_btn += "<button type='button' id='process_btn' name='process_btn' class='btn btn-secondary' style='font-size: 13px;' value='" + value.REG_ID + "' data-toggle='modal' data-target='#process_stud_modal'>PROCESS STUDENT</button>";
									break;
								case 3:
									action_btn += "<button type='button' id='send_coe' name='send_coe' class='btn btn-warning' style='font-size: 13px;' value='" + value.REG_ID + "' data-toggle='modal' data-target='#send_coe_modal'>SEND COE</button>";
									break;
								case 4:
									action_btn += "<button type='button' id='student_enrolled' name='student_enrolled' class='btn btn-outline-success' style='font-size: 13px;' value='" + value.REG_ID + "'>STUDENT ENROLLED</button>";
									break;
								default:
									console.log("ERROR")
							}
						} else if (value.payment_remarks == 'installment') {
							action_btn += "<button type='button' id='other_payments' name='other_payments' class='btn btn-outline-primary other_payments' style='font-size: 13px;' value='" + value.REG_ID + "'>OTHER PAYMENTS</button>";
						}

						child_arr.push(count,
							value.PAYMENT_SUBMITTED_DATE,
							value.TRANSACTION_TYPE,
							value.BANK,
							value.AMOUNT,
							value.TRANSACTION_DATE,
							value.REFERENCE_ID,
							payment_label,
							action_btn);
						parent_arr.push(child_arr);
						count++;
					});
					$('#regtable').DataTable().clear().rows.add(parent_arr).draw();
					// console.log(result);
					// $("#regtable").DataTable().ajax.reload();
				} else {
					$('#regtable').DataTable().clear();
				}
				// stud_reg_id = 0;
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			}
		},
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
	$('#regtable').parents('div.dataTables_wrapper').first().hide();

	$(document).on("click", '.PaymentTrend', function () {
		$('#finance-table_filter > label > input[type=search]').val('');
		$('#finance-table_wrapper').hide();
		$('#student-transaction').show();

		stud_reg_id = $(this).val();
		// console.log(stud_reg_id);

		$('#regtable').DataTable().clear().rows.add(parent_arr).draw();
		$("#regtable").DataTable().ajax.reload();
		$('#regtable').parents('div.dataTables_wrapper').first().show();
	});

	$(document).on("click", '.viewDetails', function () {
		$('#finance-table_wrapper').hide();
		$('#student-transaction').hide();
		$('#payment-details').show();
		// stud_reg_id = $(this).val();
		var receipt = $(this).val();
		id = receipt;
		$.ajax({
			type: 'GET',
			url: '../controller/FinanceInfo.php',
			data:
			{
				type: 'STUD_DETAILS',
				receipt_id: receipt
			},
			dataType: 'json',
			success: function (result) {
				// console.log(id)
				$('#lastname').val(result.schlenrollprereg_lname);
				$('#firstname').val(result.schlenrollprereg_fname);
				$('#middlename').val(result.schlenrollprereg_mname);
				$('#suffix').val(result.schlenrollprereg_suffix);
				$('#mobilenumber').val(result.schlenrollprereg_mobileno);
				$('#telephone').val(result.schlenrollprereg_telno);
				$('#emailaddress').val(result.schlenrollprereg_emailadd);
				$("#transaction").val(result.transaction_type).change();
				$('#amount').val(result.amount);
				$("#bank").val(result.bank).change();
				$('#referenceNumber').val(result.reference_number);
				$('#transaction_date').val(result.transaction_date);
				$('#payment_type').val(result.payment_remarks).change();
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			}
		});
	});

	$(document).on("click", '#cancel', function () {
		$('#finance-table_wrapper').hide();
		$('#student-transaction').show();
		$('#payment-details').hide();
		// $('#regtable').DataTable().clear().draw();
		$("#regtable").DataTable().ajax.reload();
	});

	$(document).on("click", '#process_btn', function () {
		stud_reg_id = $(this).val();
		$.ajax({
			type: 'POST',
			url: '../controller/FinancePost.php',
			data:
			{
				type: 'PROCESS_STUDENT',
				process_id: stud_reg_id
			},
			dataType: 'json',
			success: function (result) {
				console.log(stud_reg_id);
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			}
		});
	});

	$(document).on("click", '#send_coe', function () {
		stud_reg_id = $(this).val();
		$.ajax({
			type: 'POST',
			url: '../controller/FinancePost.php',
			data:
			{
				type: 'SEND_COE',
				enroll_id: stud_reg_id
			},
			dataType: 'json',
			success: function (result) {
				console.log(stud_reg_id);
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			}
		});
	});

	$(document).on("click", '#other_payments', function () {
		alert("other_payments");
	});

	$(document).on("click", '#verify_payment', function () {
		// id = $(this).val();
		// console.log(id)
		$.ajax({
			type: 'POST',
			url: '../controller/FinancePost.php',
			data:
			{
				type: 'VERIFY_PAYMENT',
				receipt_id: id
			},
			dataType: 'json',
			success: function (result) {
				alert(id)
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			}
		});
	});

	$(document).on("click", '#view_document', function () {
		$('#view-documents').show();
		$('#student-transaction').hide();
		$('#payment-details').hide();
		$.ajax({
			type: 'GET',
			url: '../controller/FinanceInfo.php',
			data:
			{
				type: 'VIEW_DOCUMENT',
				receipt_id: id,
			},
			dataType: 'json',
			success: function (result) {
				$("#bg").attr('src', result.document_location);
				$("#download_document_link").attr('href', '../controller/DownloadController.php?id=1588');
				// console.log(id)
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			}
		});
	});

	$(document).on("click", '#return_to_student', function () {
		$('#view-documents').hide();
		$('#payment-details').show();
	});

	$(document).on("click", '#close_modal', function () {
		$('#finance-table_wrapper').hide();
		$('#student-transaction').show();
		$('#payment-details').hide();
		// $('#regtable').DataTable().clear().draw();
		$("#regtable").DataTable().ajax.reload();
	});

	// $(document).on("click", '#download_document', function () {
	// 	// console.log(id);
	// 	$.ajax({
	// 		type: 'GET',
	// 		url: '../controller/DownloadController.php',
	// 		data:
	// 		{
	// 			type: 'DOWNLOAD_DOCUMENT',
	// 			document_id: id,
	// 		},
	// 		dataType: 'json',
	// 		success: function (result) {
	// 			console.log(id)
	// 		},
	// 		error: function (request, status, error) {
	// 			console.log(request.responseText);
	// 		}
	// 	});
	// });
});

$(document).on('change', '#payment_type', function () {
	remarks = $(this).val();
	console.log(id)
	console.log(remarks)
	$.ajax({
		type: 'POST',
		url: '../controller/FinancePost.php',
		data:
		{
			type: 'PAYMENT_REMARKS',
			receipt_id: id,
			remarks: remarks
		},
		dataType: 'json',
		success: function () {
			console.log(remarks)
		}
		// error: function (request, status, error) {
		// 	console.log(request.responseText);
		// }
	});
});

