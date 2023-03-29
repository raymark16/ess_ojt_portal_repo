<!docTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
		<link rel="icon" href="../../image/fcpc_logo.ico"/>

		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>

		<title>FCPC ESS TEAMLEADER DASHBOARD</title>
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

		?>
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

			<h1 align="center" style="font-size: 50px; color: blue;">FIRST CITY
				PROVIDENTIAL COLLEGE</h1>
			<div align="center" style="font-size: 30px;text-decoration-line: underline;"> FINANCE
				MANAGEMENT DASHBOARD </div>
				<br> 



			<div classs='container' id='finance-dasboard' style="max-height: 100vh; overflow: scroll;">

	            <table id='finance-table' class='table table-hover table-bordered'>   
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
	                        	<label class="text-danger" > NO RECORD FOUND </label> 
	                        </td>
	                        	                        
	                    </tr>
	                </tbody>
	            </table>
        	</div>


		</div>


	</body><br>
	<footer class="footer">
	    <div class="container">
	        <div class="row">
	            <div class="col-mg-3" align="center">
	                <h7>Copyrights © All right reserved 2022 FCPC</h7>
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