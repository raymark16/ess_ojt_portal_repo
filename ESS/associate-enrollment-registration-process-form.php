<?php
	session_start();
	if(!isset($_SESSION["USERID"])){
		header("Location: Login.php");
		exit();
	}
	// if(!isset($_SESSION['USERID']))//$_GET['userid']))//$_SESSION['userid']) && isset($_GET['userid']))//$_SESSION['userid']))
	// {
		// //$userid = intval($_SESSION['userid']);
		// //$userid = intval($_GET['prcss_id']);
		// $userid = intval($_POST['userid']);
	// } else ;
	// {
		// header('location: login.php');
		// $userid = 0;
	// }
	
	if (isset($_GET['logout'])) 
	{
    	session_destroy();
    	unset($_SESSION['username']);
    	unset($_SESSION['first_name']);
    	unset($_SESSION['last_name']);
    	unset($_SESSION['position']);
    	header('location: login.php');
		exit();
  	}
	include('controller/class/configuration/connection.php');
		
	$qryreg = "SELECT `reg`.`schlenrollprereg_regdate` `REG_DATE`
				FROM `school_enrollment_pre_registration` `reg`
				WHERE `reg`.`enrollagent_id` = ".$_SESSION['USERID']. " AND `reg`.`ready_for_assesment` = 1
				ORDER BY `reg`.`schlusr_id`,`reg`.`schlenrollprereg_id` DESC";
							
	$rsreg = $dbConn->query($qryreg);

	$number_of_result = mysqli_num_rows($rsreg);  
    $results_per_page = 100;  
	$number_of_page = ceil ($number_of_result / $results_per_page);  

	if (!isset ($_GET['page']) ) {  
        $page = 1;  
		$_SESSION['last_page'] = 1;
    } else {  
		if($_GET['page'] == 'previous'){
			$page = $_SESSION['last_page'] == 1 ? 1 : $_SESSION['last_page']-1;
			$_SESSION['last_page'] = $page;
		}elseif($_GET['page'] == 'next'){
			$page = $_SESSION['last_page'] == $number_of_page ? $_SESSION['last_page'] : $_SESSION['last_page']+1;
			$_SESSION['last_page'] = $page;
		}elseif($_GET['page'] == 'last'){
			$page = $number_of_page;
			$_SESSION['last_page'] = $page;
		}else{
			$page = $_GET['page'];  
			$_SESSION['last_page'] = $page;
		}
    }  

	$page_first_result = ($page-1) * $results_per_page;  

	$qryreg = "SELECT `reg`.`schlenrollprereg_regdate` `REG_DATE`,
					  UPPER(CONCAT(`reg`.`schlenrollprereg_lname`, ', ', `reg`.`schlenrollprereg_fname` , ' ' , `reg`.`schlenrollprereg_mname`)) `NAME`,
					  UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
					  UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
					  UPPER(`crse`.`schlacadcrse_code`) `CRSE_NAME`, 
					  `reg`.`schlusr_id` `USER_ID`,
					  `reg`.`schlenrollprereg_verification` `VERIFY`, 
					  `reg`.`schlenrollprereg_id` `VIEW`,
					  `reg`.`schlenrollprereg_id` `PROCESS`
					FROM `school_enrollment_pre_registration` `reg`
						LEFT JOIN `school_academic_level` `lvl`
							ON `reg`.`acadlvl_id`=`lvl`.`schlacadlvl_id`
						LEFT JOIN `school_academic_year_level` `yrlvl`
							ON `reg`.`acadyrlvl_id`=`yrlvl`.`schlacadyrlvl_id`
						LEFT JOIN `school_academic_course` `crse`
							ON `reg`.`acadcrse_id`=`crse`.`schlacadcrse_id`
						LEFT JOIN `school_users` `usr`
							ON `reg`.`schlusr_id`=`usr`.`schlusr_id`
							WHERE `reg`.`enrollagent_id` = ".$_SESSION['USERID']. " 
							AND `reg`.`ready_for_assesment` = 1
							ORDER BY `reg`.`schlenrollprereg_verification` DESC, `reg`.`schlenrollprereg_regdate` DESC
							LIMIT " . $page_first_result . "," . $results_per_page;

	$rsreg = $dbConn->query($qryreg);
	$fetchDatareg = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	
	$qryuser = "SELECT `schlusr_lname` `NAME`,
				       `schlusr_id` `USER_ID`
				FROM `school_users`
					WHERE `schlusr_status` = 1 
					AND `schlusr_isactive` = 1";
	$rsuser = $dbConn->query($qryuser);
	$fetchDatauser = $rsuser->fetch_ALL(MYSQLI_ASSOC);
?>
	<link href="tool/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
	<script src="tool/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="tool/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="images/fcpc_logo_2.ico">	
    <title> ASSOCIATE DASHBOARD</title>


    <body style="border:1px solid background: 
                                  rgba(191,217,250,0.8); 
                                  background-image: url('image/FCPC LOGO.png');
                                  background-size: 70%;
                                  background-repeat: no-repeat;
                                  background-position: center;
                                  padding-bottom: 0;
                                  padding-top: 0;
                                  background-op;">
  	<div class="container">
  		<br>
          <h1 align="center" style="font-size: 50px; font-family: 'Times New Roman', Times, serif;color: blue;">FIRST CITY PROVIDENTIAL COLLEGE</h1>
          <div align="center" style="font-size: 30px;font-style: normal;text-decoration-line: underline;"> ASSOCIATE DASHBOARD </div>
        <br>
  	</div>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-2">
  				<!--
  				<div class="dropdown">
					<label class="btn btn-secondary dropdown-toggle" type="label" id="dropdownMenulabel1" data-bs-toggle="dropdown" aria-expanded="false">Display Data</label>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenulabel1">
						<li><a class="dropdown-item" href="#">25</a></li>
						<li><a class="dropdown-item" href="#">50</a></li>
						<li><a class="dropdown-item" href="#">100</a></li>
					</ul>
				</div>
				-->
  			</div>
  			<div class="col-md-2"></div>
  			<div class="col-md-2"></div>
  			<div class="col-md-2"></div>
			<div class="col-md-4">
			<form class="d-flex">
				    <a class="dropdown-item" disabled></a>
					<a href="associate-enrollment-registration-process-form.php?logout='1'"><label type='label' class='btn btn-danger'>LOGOUT </label></a>
			</form>
  			</div>
  		</div>
  	</div>
  	<br>
    <div class="container" id="table-list">
		<div id="prereg-data"></div>
	<?php
		$createTable  = "<table id='regtable' class='table caption-top table-hover'>";
		$createTable .= "<thead class='table-primary'>";
		$createTable .= "<tr>";
		$createTable .= "<th scope='col' style='text-align:center;'>#</th>";
		$createTable .= "<th scope='col' style='text-align:center;'>Timestamp</th>";
		$createTable .= "<th scope='col' style='text-align:center;'>Student Name</th>";
		$createTable .= "<th scope='col' style='text-align:center;'>Level</th>";
		$createTable .= "<th scope='col' style='text-align:center;'>Grade Level</th>";
		$createTable .= "<th scope='col' style='text-align:center;'>Course Strand</th>";
		$createTable .= "<th scope='col' style='text-align:center;'>Status</th>";
		$createTable .= "</tr>";
		$createTable .= "</thead>";
		$createTable .= "<tbody>";
		$createTable .= "<div></div>";
		$count = 1;
		foreach($fetchDatareg as $regitem)
		{	
			
			$createTable .= "<tr>";
			$createTable .= "<td style='text-align:center;' class='table-primary'>".$count++."</td>";
			$createTable .= "<td style='text-align:center;'>".$regitem['REG_DATE']."</td>";
			$createTable .= "<td style='text-align:center;'>".$regitem['NAME']."</td>";
			$createTable .= "<td style='text-align:center;'>".$regitem['LVL_NAME']."</td>";
			$createTable .= "<td style='text-align:center;'>".$regitem['YRLVL_NAME']."</td>";
			$createTable .= "<td style='text-align:center;'>".$regitem['CRSE_NAME']."</td>";

			$createTable .= "<td  style='text-align:center;'>";
			if($regitem['VERIFY'] == 0)
			{
				$createTable .= "<label type='label' class='btn btn-outline-secondary'>To be Verified</label>";
			}
			
			if($regitem['VERIFY'] == 1)
			{
				$createTable .= "<label type='label' class='btn btn-outline-warning'>To be processed</label>";
			}
			else if($regitem['VERIFY'] == 2)
			{
				$createTable .= "<label type='label' class='btn btn-outline-info'>Student Processed</label>";
			}
			else if($regitem['VERIFY'] == 3)
			{
				$createTable .= "<label type='label' class='btn btn-outline-primary'>Financed Processed</label>";

			}
			else if($regitem['VERIFY'] == 4)
			{
				$createTable .= "<label type='label' class='btn btn-outline-success'>Student Enrolled</label>";
			}

			$createTable .= "</td>";
			$createTable .= "</tr>";
		}
		$createTable .= "</tbody>";
		$createTable .= "</table>";
			
		echo $createTable;
		$rsreg->close();
		//$dbConn->close();
	?>

    </div>	
    <div class="container">
    	<div class="row">
    		<div class="col-md-4"></div>
    		<div class="col-md-4">
				<nav aria-label="Page navigation example">
					<ul class="pagination">
					<?php include 'pagination.php' ?>
					</ul>
				</nav>
			</div>
			<div class="col-md-4"></div>
    	</div>
		<div class="row">
    		<div class="col-md-8">&nbsp;</div>
    	</div>
    </div>
	<script>
	$(document).ready(function(){
		var table = $('#regtable').DataTable();
		var searchtxt = $('#searchtxt').val();
		var filteredData = table
			.columns( 1 )
			.data()
			.flatten()
			.filter( function ( value, index ) {
				return value = searchtxt ? true : false;
		});
		/*$('.list li').click(function(e) {
			var clicked_element_value = $(this).attr("value");
			var parent = $(this).parent().attr('name');
			alert($("#" + parent).val(clicked_element_value));
		});*/

	});
  </script>
  <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-mg-3" align="center">
                <h7>Copyrights © All right reserved 2021 FCPC</h7>
            </div>
        </div>
        <div class="row">
            <div class="col-mg-3" align="center">
                <h5>First City Providential College, Inc.</h5>
            </div>
        </div>
    </div>
</footer>
<br>
</body>
 