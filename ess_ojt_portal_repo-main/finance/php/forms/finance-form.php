<!docTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	<link rel="icon" href="../../image/fcpc_logo.ico" />

	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>

	<title>FCPC FINANCE DASHBOARD</title>

	<style>
		label {
			color: royalblue;
			font-weight: bold;
			display: block;
			float: left;
		}
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<?php
	echo '<link href="../../tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>';
	echo '<link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet"/>';
	echo '<link rel="stylesheet" href="../../css/bootstrap.css">';
	echo '<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>';
	// echo '<link rel="stylesheet" href="../../css/registration.css">';
	// echo '<link rel="stylesheet" href="../../css/sidebar.css">';
	
	echo '<script src="../../tool/jquery-3.6.0.min.js"></script>';

	// -- JS -- 
	
	echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"/>';
	echo '<script src="../../tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>';
	// echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>';
	// echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />';
	echo '<script src="../../js/finance-script.js"></script>';

	echo '<script src="https://code.jquery.com/jquery-3.5.1.js"></script>';
	echo '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>';
	echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>';
	// echo '<script src="https://code.jquery.com/jquery-3.5.1.js"></script>';
	echo '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>';
	echo '<script src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>';

	// echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>';
	// echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />';
	
	?>
	<style>
		#finance-table_length label,
		#finance-table_filter label,#regtable_length label,#regtable_filter label {
			font-family: inherit;
			text-transform: uppercase;
			color: inherit;
			margin-bottom: 5px;
		}
	</style>
</head>

<body style="	font-family: 'Gill Sans', sans-serif; 
					border:1px solid background: 
					rgba(191,217,250,0.8); 
					background-image: url('../../image/FCPC LOGO.png');
					background-size: 60%;
					background-repeat: no-repeat;
					background-position: center;
					padding-bottom: 0;
					padding-top: 0;
					background-op;
					">

	<div class="container"><br>
		<h1 align="center" style="font-size: 50px; color: blue;">FIRST CITY PROVIDENTIAL COLLEGE</h1>
		<div align="center" style="font-size: 30px;text-decoration-line: underline;"> FINANCE MANAGEMENT DASHBOARD
		</div>
		<br>

		<div class="container">
			<div class='container' id='finance-dasboard'>
				<table id='finance-table' class='table table-hover table-bordered' style="font-size:12px;text-align: center;" width="100%">
					<thead class='table-primary'>
						<!-- <tr>    
							<th scope='col' style='text-align:center;'>#</th>   
							<th scope='col' style='text-align:center;'>TIMESTAMP</th>   
							<th scope='col' style='text-align:center;'>STUDENT NAME</th>    
							<th scope='col' style='text-align:center;'>STUDENT TYPE</th>    
							<th scope='col' style='text-align:center;'>LEVEL</th>   
							<th scope='col' style='text-align:center;'>GRADE LEVEL</th> 
							<th scope='col' style='text-align:center;'>STRAND/PROGRAM</th>   
							<th scope='col' style='text-align:center;'>STATUS</th>  
							<th scope='col' style='text-align:center;' colspan=2 >ACTION</th>  
						</tr>    -->
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

			<div class='container' id="student-transaction">
				<br><br>
				<table id='regtable' class='table table-hover table-responsive table-bordered'
					style='text-align:center;font-size:12px'>
					<thead class='table-primary'>
						<tr>
							<th scope='col'>#</th>
							<th scope='col'>Date</th>
							<th scope='col'>Transaction</th>
							<th scope='col'>Bank name</th>
							<th scope='col'>Amount</th>
							<th scope='col'>Transaction Date</th>
							<th scope='col'>Transaction Number</th>
							<th scope='col'>Payment Status</th>
							<th colspan=2>
								<center>ACTIONS</center>
							</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<td colspan=10>
								<center><button type="button" id="return" style='font-size: 40;'
										class='btn btn-secondary'>GO BACK</button></center>
							</td>
						</tr>
					</tfoot>
				</table>
				<div class="modal fade" id="process_stud_modal" tabindex="-1" role="dialog"
					aria-labelledby="process_stud_modalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="process_stud_modalLabel"></h5>
								<button type="button" id="close_modal" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Student is processed successfully!
							</div>
							<div class="modal-footer">
								<button type="button" id="close_modal" class="btn btn-secondary"
									data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="send_coe_modal" tabindex="-1" role="dialog"
					aria-labelledby="send_coe_modalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="send_coe_modalLabel"></h5>
								<button type="button" id="close_modal" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Student is enrolled successfully!
							</div>
							<div class="modal-footer">
								<button type="button" id="close_modal" class="btn btn-secondary"
									data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class='container' id="payment-details">
				<br><br>
				<div align="center" style="background-color: lightblue;">
					<h2>STUDENT INFORMATION</h2>
				</div>

				<form>
					<div class="row">
						<div class="col-md-3">
							<label>Last name *</label>
							<input type="text" id="lastname" name="lastname" placeholder="" class="form-control"
								maxlength="40" required disabled>
						</div>
						<div class="col-md-3">
							<label>First name *</label>
							<input type="text" id="firstname" name="firstname" placeholder="" class="form-control"
								maxlength="40" required disabled>
						</div>
						<div class="col-md-3">
							<label>Middle name *</label>
							<input type="text" id="middlename" name="middlename" placeholder="" class="form-control"
								maxlength="40" required disabled>
						</div>
						<div class="col-md-3">
							<label>Suffix</label>
							<input type="text" id="suffix" name="suffix" placeholder="" class="form-control"
								maxlength="40" required disabled>
						</div>
					</div>
					<br>
					<br>

					<div align="center" style="background-color: lightblue;">
						<h2>CONTACT INFORMATION</h2>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label>Mobile Number *</label>
							<input type="text" id="mobilenumber" name="mobilenumber" placeholder="" class="form-control"
								maxlength="40" required disabled>
						</div>
						<div class="col-md-3">
							<label>Telephone *</label>
							<input type="text" id="telephone" name="telephone" placeholder="" class="form-control"
								maxlength="40" required disabled>
						</div>
						<div class="col-md-3">
							<label>Email Address*</label>
							<input type="text" id="emailaddress" name="emailaddress" placeholder="" value=""
								class="form-control" maxlength="40" required disabled>
						</div>
					</div>
					<br>

					<!-- PAYMENT INFORMATION -->
					<div align="center" class="mb-3" style="background-color: lightblue;">
						<h2>PAYMENT DOCUMENTS</h2>
					</div>
					<div class="row mb-3">
						<div class="col-md-6">
							<label for="transaction" class="form-label">Transaction Type *</label>
							<select id="transaction" name="transaction" class="form-control" required disabled>
								<option value='g-cash'>g-cash</option>
								<option value='online'>online</option>
							</select>
						</div>
						<div class="col-md-6 amount bank">
							<label class="form-label" for="amount">Amount Paid *</label>
							<input type="text" id="amount" name="amount" placeholder="" class="form-control bank amount"
								maxlength="40" required disabled>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-md-4 bank">
							<label for="bank" class="form-label">Bank Name *</label>
							<select id="bank" name="bank" class="form-control bank" required disabled>
								<option value='bdo'>bdo</option>
								<option value='g-cash'>g-cash</option>
							</select>
						</div>
						<div class="col-md-4 bank">
							<label class="form-label" for="referenceNumber">Transaction Reference Number *</label>
							<input type="text" id="referenceNumber" name="referenceNumber" placeholder="0008291502601"
								class="form-control bank" maxlength="40" required disabled>
						</div>
						<div class="col-md-4 bank">
							<label class="form-label" for="date">Transaction date *</label>
							<input type="text" id="transaction_date" name="transaction_date" placeholder=""
								class="form-control bank" required disabled>
						</div>
					</div>
					<div class="row bank">
						<div class="col-md-4">
							<label class="form-label text-danger" for="payment_type"> Select Payment Remarks *</label>
							<select id='payment_type' name='payment_type' class='form-control dropdown' required>
								<option value="NULL"> -- Select Payment Remarks -- </option>
								<option value="tuition"> Tuition Fee </option>
								<option value="installment"> Installments </option>
							</select>
						</div>
					</div>
					<br>
					<hr>
					<!-- STUDENT DOCUMENTS -->
					<div align="center" class="mb-3" style="background-color: lightblue;">
						<h2>STUDENT DOCUMENTS</h2>
					</div>
					<div id='view_document_section' class="col-md-3">
						<!-- <label id='view_document' class='btn btn-info form-control download_link download_link' style='font-size: 20;'>
							<span class='iconify' data-icon='bx:download'></span>View Document
						</label> -->
						<!-- <button type="button" id="view_document" name="view_document" class="btn btn-info form-control download_link download_link" value=""
							style="font-size: 40;">View Document</button> -->
						<button type="button" id="view_document" style='font-size: 40;'
							class="btn btn-info form-control download_link download_link"><span class='iconify'
								data-icon='bx:download'></span>View Documents</button>
						<p id="no_document"><em>No available document.</em></p>
					</div>
					<br><br>
					<hr>
					<div align="center">
						<button type="button" id="verify_payment" name="verify_payment" class="btn btn-primary" value=""
							style="font-size: 40;" data-toggle='modal' data-target='#verify_payment_modal'>VERIFY
							PAYMENT</button>
						<button type="button" id="cancel" style='font-size: 40;'
							class='btn btn-secondary'>CANCEL</button>
					</div>
					<div class="modal fade" id="verify_payment_modal" tabindex="-1" role="dialog"
						aria-labelledby="verify_payment_modalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="verify_payment_modalLabel"></h5>
									<button type="button" id="close_modal" class="close" data-dismiss="modal"
										aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Payment is verified successfully!
								</div>
								<div class="modal-footer">
									<button type="button" id="close_modal" class="btn btn-secondary"
										data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

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
			<hr>
		</div>
	</div>
	</div>
</body><br>
<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-mg-3" align="center">
				<h7>Copyrights © All right reserved 2023 FCPC</h7>
			</div>
		</div>
		<div class="row">
			<div class="col-mg-3" align="center">
				<h5>First City Providential College, Inc.</h5>
			</div>
		</div>
	</div>
</footer>

</html>