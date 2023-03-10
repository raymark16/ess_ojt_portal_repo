<?php 
require_once('../configuration/connection.php');

if(isset($_GET['schlacadyrlvl_id']) && is_numeric($_GET['schlacadyrlvl_id']) 
	&& isset($_GET['schlacadlvl_id']) && is_numeric($_GET['schlacadlvl_id']))
{
	$acadlvl_id = intval($_GET['schlacadlvl_id']);
	$acadyrlvl_id = intval($_GET['schlacadyrlvl_id']);
	$qry = "SELECT schlacadcrse_id,
				   schlacadcrse_name
			  From school_academic_course 
				WHERE schlacadcrse_status = 1 
					AND schlacadcrse_isactive = 1 
					AND schlacadyrlvl_id = ".$acadyrlvl_id." AND schlacadlvl_id = ".$acadlvl_id." ORDER BY schlacadcrse_name";

	$rs = $dbConn->query($qry);

	$fetchAllDataCourse = $rs->fetch_ALL(MYSQLI_ASSOC);
	$createDropDownCourse  = "<p>Academic Strand/Program/Course</p>";
	$createDropDownCourse  .= "<select id='academiccourse-list' name='academic_course' class='form-control'>";
	$createDropDownCourse .= "<option value='0'> -- select strand/program/course -- </option>";
	foreach($fetchAllDataCourse as $academiccourse)
	{
		$createDropDownCourse .= "<option value='".$academiccourse['schlacadcrse_id']."'>".$academiccourse['schlacadcrse_name']."</option>";
	}

	$createDropDownCourse .= '</select>';
	echo $createDropDownCourse;

	$rs->close();

	$dbConn->close();
} else {
	$createDropDownCourse   = "<p>Academic Strand/Program/Course</p>";
	$createDropDownCourse  .= "<select id='academiccourse-list' name='academic_course' class='form-control'>";
	$createDropDownCourse .= "<option value='0'> -- select strand/program/course -- </option>";
	$createDropDownCourse .= "</select>";
	echo $createDropDownCourse;
	
	/*$createTable = '<table>';
	$createTable .= '<tr>';
	$createTable .= '<th>Name</th>';
	$createTable .= '<th>Code</th>';
	$createTable .= '<th>Description</th>';
	$createTable .= '<th>Status</th>';
	$createTable .= '<th>Is-Active</th>';
	$createTable .= '</tr>';


	foreach($fetchAllData as $academiclevel)
	{
		$createTable .= '<tr>';
		$createTable .= '<td>'.$academiclevel['schlacadlvl_code'].'</td>';
		$createTable .= '<td>'.$academiclevel['schlacadlvl_name'].'</td>';
		$createTable .= '<td>'.$academiclevel['schlacadlvl_desc'].'</td>';
		$createTable .= '<td>'.$academiclevel['schlacadlvl_status'].'</td>';
		$createTable .= '<td>'.$academiclevel['schlacadlvl_isactive'].'</td>';
		$createTable .= '</tr>';	
	}

	$createTable .= '</table>';
	*/
}
?>