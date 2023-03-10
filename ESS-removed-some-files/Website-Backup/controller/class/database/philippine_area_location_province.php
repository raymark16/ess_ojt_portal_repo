<?php 
	//require_once('../configuration/connection.php');
	require_once('controller/class/configuration/connection.php');
	$qryprovince = "SELECT philarealocprov_name,
						   philarealocprov_id
						FROM philippine_area_location_province
							WHERE philarealocprov_isactive = 1 
								AND philarealocprov_status = 1";
	$rsprovince = $dbConn->query($qryprovince);
	$fetchAllDataProvince = $rsprovince->fetch_ALL(MYSQLI_ASSOC);
	$rsprovince->close();
	//$dbConn->close();
?>
<script>
	$(document).ready(function(){
		$("#present-province-list").change(function(){
			$("#loader").show();
			var getProvinceID = $(this).val();
			var getConrolID = "present";
			$.ajax({
				type: 'GET',
				url: 'controller/class/database/philippine_area_location_municipality.php',
				data: {philarealocprov_id:getProvinceID,control_id:getConrolID},
				success: function(data){
					$("#loader").hide();
					$("#present-municipality-data").html(data);
				}
			});
		});
		$("#present-province-list").click(function(){
			$("#loader").show();
			var getProvinceID = $(this).val();
			var getConrolID = "present";
			$.ajax({
				type: 'GET',
				url: 'controller/class/database/philippine_area_location_municipality.php',
				data: {philarealocprov_id:getProvinceID,control_id:getConrolID},
				success: function(data){
					$("#loader").hide();
					$("#present-municipality-data").html(data);
				}
			});
		});
		$("#present-province-list").ready(function(){
			$("#loader").show();
			var getProvinceID = $(this).val();
			var getConrolID = "present";
			$.ajax({
				type: 'GET',
				url: 'controller/class/database/philippine_area_location_municipality.php',
				data: {philarealocprov_id:getProvinceID,control_id:getConrolID},
				success: function(data){
					$("#loader").hide();
					$("#present-municipality-data").html(data);
				}
			});
		});
		$("#permanent-province-list").change(function(){
			$("#loader").show();
			var getProvinceID = $(this).val();
			var getConrolID = "permanent";
			$.ajax({
				type: 'GET',
				url: 'controller/class/database/philippine_area_location_municipality.php',
				data: {philarealocprov_id:getProvinceID,control_id:getConrolID},
				success: function(data){
					$("#loader").hide();
					$("#permanent-municipality-data").html(data);
				}
			});
		});
		$("#permanent-province-list").click(function(){
			$("#loader").show();
			var getProvinceID = $(this).val();
			var getConrolID = "permanent";
			$.ajax({
				type: 'GET',
				url: 'controller/class/database/philippine_area_location_municipality.php',
				data: {philarealocprov_id:getProvinceID,control_id:getConrolID},
				success: function(data){
					$("#loader").hide();
					$("#permanent-municipality-data").html(data);
				}
			});
		});
		$("#permanent-province-list").ready(function(){
			$("#loader").show();
			var getProvinceID = $(this).val();
			var getConrolID = "permanent";
			$.ajax({
				type: 'GET',
				url: 'controller/class/database/philippine_area_location_municipality.php',
				data: {philarealocprov_id:getProvinceID,control_id:getConrolID},
				success: function(data){
					$("#loader").hide();
					$("#permanent-municipality-data").html(data);
				}
			});
		});
	});
</script>
