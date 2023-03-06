<!docTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
		<link rel="icon" href="../../image/fcpc_logo.ico"/>

		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>

		<title>FCPC FINANCE DASHBOARD</title>

		<style>
			label
			{
				color: royalblue;
				font-weight: bold;
				display: block;
				float: left;
			}

		</style>

		<?php 
			echo '<link href="../../tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>';
			echo '<link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet"/>';
			echo '<link rel="stylesheet" href="../../css/bootstrap.css">';

			// echo '<link rel="stylesheet" href="../../css/registration.css">';
			// echo '<link rel="stylesheet" href="../../css/sidebar.css">';

			echo '<script src="../../tool/jquery-3.6.0.min.js"></script>';

			// -- JS -- 

			echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"/>';
		   	echo '<script src="../../tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>';

			echo '<script src="../../js/finance-script.js"></script>';
			echo '<script src="../../js/tables.js"></script>';
			
			echo '<script src="https://code.jquery.com/jquery-3.5.1.js"></script>';
			echo '<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>';
			echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>';
		?>
		<style>
			#finance-table_length label, #finance-table_filter label {
				font-family: inherit;
				text-transform:  uppercase;
				color: inherit;
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
			<div align="center" style="font-size: 30px;text-decoration-line: underline;"> FINANCE MANAGEMENT DASHBOARD </div>
				<br> 

			<div class="container" style="max-height: 100vh; overflow: scroll;">
				<div class='container' id='finance-dasboard'>

	            <table id='finance-table' class='table table-hover table-bordered' style="font-size:13px">   
	                <thead class='table-primary'>   
	                    <tr>    
	                        <th scope='col' style='text-align:center;'>#</th>   
	                        <th scope='col' style='text-align:center;'>TIMESTAMP</th>   
	                        <th scope='col' style='text-align:center;'>STUDENT NAME</th>    
	                        <th scope='col' style='text-align:center;'>STUDENT TYPE</th>    
	                        <th scope='col' style='text-align:center;'>LEVEL</th>   
	                        <th scope='col' style='text-align:center;'>GRADE LEVEL</th> 
	                        <th scope='col' style='text-align:center;'>STRAND/PROGRAM</th>   
	                        <th scope='col' style='text-align:center;'>STATUS</th>  
	                        <th scope='col' style='text-align:center;' colspan=2 >ACTION</th>  
	                    </tr>   
	                </thead>    
	                <tbody id='finance-records'>
	                    <tr  style="text-align: center;">
	                        <td colspan = "10"> 
	                        	<label class="text-danger" style="text-align: center;"> NO RECORD FOUND </label> 
	                        </td>
	                        	                        
	                    </tr>
	                </tbody>
	            </table>
				
        	</div>
        	
        	<div class='container' id="student-transaction">
				<br><br>
        		<table id='regtable' class='table table-hover table-responsive table-bordered'style='text-align:center;'>
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
				        	<th scope='col' colspan=2 >Actions</th>
			        	</tr>
		        	</thead>
		        	<tbody>

		        	</tbody>
		        </table>
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
							<input type="text" id="lastname" name="lastname" placeholder="" class="form-control" maxlength="40" required disabled>
						</div>
						<div class="col-md-3">
							<label>First name *</label>
							<input type="text" id="firstname" name="firstname" placeholder="" class="form-control" maxlength="40" required disabled>
						</div>
						<div class="col-md-3">
							<label>Middle name *</label>
							<input type="text" id="middlename" name="middlename" placeholder="" class="form-control" maxlength="40" required disabled>
						</div>
						<div class="col-md-3">
							<label>Suffix</label>
							<input type="text" id="suffix" name="suffix" placeholder="" class="form-control" maxlength="40" required disabled>
						</div>
					</div><br><br>

					<div align="center" style="background-color: lightblue;"><h2>CONTACT INFORMATION</h2></div>
			        <div class="row">
			        	<div class="col-md-3">
			        		<label>Mobile Number *</label>
			            	<input type="text" id="mobilenumber" name="mobilenumber" placeholder="" class="form-control" maxlength="40" required disabled>
			          	</div>
			          	<div class="col-md-3">
			          		<label>Telephone *</label>
			            	<input type="text" id="telephone" name="telephone" placeholder="" class="form-control" maxlength="40" required disabled>
			          	</div>
			          	<div class="col-md-3">
			          		<label>Email Address*</label>
			            	<input type="text" id="emailaddress" name="emailaddress" placeholder="" value="" class="form-control" maxlength="40" required disabled>
			          	</div>
			        </div>

        		</form>

        		
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