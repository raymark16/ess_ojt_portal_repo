<?php 
require_once('../configuration/connection.php');
$control_id = strval($_GET['control_id']);
if(isset($_GET['philarealocmun_id']) && is_numeric($_GET['philarealocmun_id']) && isset($_GET['control_id']))
{
	$arealocmun_id = intval($_GET['philarealocmun_id']);
	
	$qrybarangay = "SELECT philarealocbrgy_name,
				   philarealocbrgy_id
			  From philippine_area_location_barangay 
				WHERE philarealocbrgy_status=1 
					AND philarealocbrgy_isactive=1 
					AND philarealocmun_id=".$arealocmun_id." ORDER BY philarealocbrgy_name";

	$rsbarangay = $dbConn->query($qrybarangay);

	$fetchAllDataBarangay = $rsbarangay->fetch_ALL(MYSQLI_ASSOC);
	
	$createDropDownbarangay   = "<p>Barangay</p>";
	$createDropDownbarangay  .= "<select id='".$control_id."-barangay-list' name='".$control_id."-barangay' class='form-control'>";
	$createDropDownbarangay .= "<option value='0'> -- select ".$control_id." barangay -- </option>";
	foreach($fetchAllDataBarangay as $barangay)
	{
		$createDropDownbarangay .= "<option value='".$barangay['philarealocbrgy_id']."'>".$barangay['philarealocbrgy_name']."</option>";
	}
	$createDropDownbarangay .= '</select>';
	
	echo $createDropDownbarangay;

	$rsbarangay->close();

	$dbConn->close();
} else {
	$createDropDownbarangay   = "<p>Barangay</p>";
	$createDropDownbarangay  .= "<select id='".$control_id."-barangay-list' name='".$control_id."-barangay' class='form-control'>";
	$createDropDownbarangay  .= "<option value='0'> -- select ".$control_id." barangay -- </option>";
	$createDropDownbarangay  .= "</select>";
	echo $createDropDownbarangay;
}
?>