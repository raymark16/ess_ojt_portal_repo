<?php 
require_once('../configuration/connection.php');
$control_id = strval($_GET['control_id']);
if(isset($_GET['philarealocprov_id']) && is_numeric($_GET['philarealocprov_id']) && isset($_GET['control_id']))
{
	$arealocprov_id = intval($_GET['philarealocprov_id']);
	//$control_id = strval($_GET['control_id']);
	$qrymunicipality = "SELECT philarealocmun_name,
				   philarealocmun_id
			  From philippine_area_location_municipality 
				WHERE philarealocmun_status=1 
					AND philarealocmun_isactive=1 
					AND philarealocprov_id=".$arealocprov_id." ORDER BY philarealocmun_name";

	$rsmunicipality = $dbConn->query($qrymunicipality);

	$fetchAllDataMunicipality = $rsmunicipality->fetch_ALL(MYSQLI_ASSOC);
	
	$createDropDownMunicipality   = "<p>Municipality</p>";
	$createDropDownMunicipality  .= "<select id='".$control_id."-municipality-list' name='".$control_id."-municipality' class='form-control'>";
	$createDropDownMunicipality .= "<option value='0'> -- select ".$control_id." municipality -- </option>";
	foreach($fetchAllDataMunicipality as $municipality)
	{
		$createDropDownMunicipality .= "<option value='".$municipality['philarealocmun_id']."'>".$municipality['philarealocmun_name']."</option>";
	}
	$createDropDownMunicipality .= '</select>';
	
	echo $createDropDownMunicipality;

	$rsmunicipality->close();

	$dbConn->close();
} else {
	$createDropDownMunicipality   = "<p>Municipality</p>";
	$createDropDownMunicipality  .= "<select id='".$control_id."-municipality-list' name='".$control_id."-municipality' class='form-control'>";
	$createDropDownMunicipality  .= "<option value='0'> -- select ".$control_id." municipality -- </option>";
	$createDropDownMunicipality  .= "</select>";
	echo $createDropDownMunicipality;
}

$script   = "<script>";
$script   .= "$(document).ready(function(){";
$script   .= "$('#".$control_id."-municipality-list').change(function(){";
$script   .= "$('#loader').show();";
$script   .= "var getMunicipalityID = $(this).val();";
$script   .= "var getConrolID = '".$control_id."';";
$script   .= "if(getMunicipalityID != '0')";
$script   .= "{";
$script   .= "$.ajax({";
$script   .= "type:'GET',";
$script   .= "url: 'controller/class/database/philippine_area_location_barangay.php',";
$script   .= "data: {philarealocmun_id:getMunicipalityID,control_id:getConrolID},";
$script   .= "success: function(data){";
$script   .= "$('#loader').hide();";
$script   .= "$('#".$control_id."-barangay-data').html(data);";
$script   .= "}";
$script   .= "});";
$script   .= "}";
$script   .= "else";
$script   .= "{";
$script   .= "$('#loader').hide();";
$script   .= "$('#".$control_id."-barangay-data').html('');";
$script   .= "}";
$script   .= "});";
$script   .= "$('#".$control_id."-municipality-list').ready(function(){";
$script   .= "$('#loader').show();";
$script   .= "var getMunicipalityID = $(this).val();";
$script   .= "var getConrolID = '".$control_id."';";
$script   .= "if(getMunicipalityID != '0')";
$script   .= "{";
$script   .= "$.ajax({";
$script   .= "type:'GET',";
$script   .= "url: 'controller/class/database/philippine_area_location_barangay.php',";
$script   .= "data: {philarealocmun_id:getMunicipalityID,control_id:getConrolID},";
$script   .= "success: function(data){";
$script   .= "$('#loader').hide();";
$script   .= "$('#".$control_id."-barangay-data').html(data);";
$script   .= "}";
$script   .= "});";
$script   .= "}";
$script   .= "else";
$script   .= "{";
$script   .= "$('#loader').hide();";
$script   .= "$('#".$control_id."-barangay-data').html('');";
$script   .= "}";
$script   .= "});";
$script   .= "});";
$script   .= "</script>";
echo $script;
?>