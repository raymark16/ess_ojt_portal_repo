<?php 
require_once('../configuration/connection.php');
if(isset($_GET['schlacadlvl_id']) && is_numeric($_GET['schlacadlvl_id']))
{
	$acadlvlid = intval($_GET['schlacadlvl_id']);
	
	$qry = "SELECT schlacadyrlvl_id,
				   schlacadyrlvl_name
			  From school_academic_year_level 
				WHERE schlacadyrlvl_status=1 
					AND schlacadyrlvl_isactive=1 
					AND schlacadlvl_id=".$acadlvlid." ORDER BY schlacadyrlvl_rankno";

	$rs = $dbConn->query($qry);

	$fetchAllData = $rs->fetch_ALL(MYSQLI_ASSOC);
	
	$createDropDown   = "<p>Academic Year Level</p>";
	$createDropDown  .= "<select id='academicyearlevel-list' name='academic_year_level' class='form-control'>";
	$createDropDown .= "<option value='0'> -- select academic year level -- </option>";
	foreach($fetchAllData as $academicyearlevel)
	{
		$createDropDown .= "<option value='".$academicyearlevel['schlacadyrlvl_id']."'>".$academicyearlevel['schlacadyrlvl_name']."</option>";
	}

	$createDropDown .= '</select>';
	
	echo $createDropDown;

	$rs->close();

	$dbConn->close();
} else {
	$createDropDown   = "<p>Academic Year Level</p>";
	$createDropDown  .= "<select id='academicyearlevel-list' name='academic_year_level' class='form-control'>";
	$createDropDown  .= "<option value='0'> -- select academic year level -- </option>";
	$createDropDown  .= "</select>";
	echo $createDropDown;
}
?>
<script>
	$(document).ready(function(){
		$("#academicyearlevel-list").change(function(){
			var getAcademicYearLevelID = $(this).val();
			var getAcademicLevelID = $("#academiclevel-list").val();
			$.ajax({
				type:'GET',
				url: 'controller/class/database/school_academic_course.php',
				data: {schlacadyrlvl_id:getAcademicYearLevelID,schlacadlvl_id:getAcademicLevelID},
				success: function(data){
					$("#academiccourse-data").html(data);
				}
			});
			$("#loader").show();
			$.ajax({
				type:'POST',
				url: 'controller/class/database/oc_enrollment_requirement.php',
				data: {schlacadyrlvl_id:getAcademicYearLevelID,schlacadlvl_id:getAcademicLevelID},
				success: function(data){
					$("#loader").hide();
					$("#registration-requirements").html(data);
				}
			});
		});
		$("#academicyearlevel-list").click(function(){
			var getAcademicYearLevelID = $(this).val();
			var getAcademicLevelID = $("#academiclevel-list").val();
			$.ajax({
				type:'GET',
				url: 'controller/class/database/school_academic_course.php',
				data: {schlacadyrlvl_id:getAcademicYearLevelID,schlacadlvl_id:getAcademicLevelID},
				success: function(data){
					$("#academiccourse-data").html(data);
				}
			});
			$("#loader").show();
			$.ajax({
				type:'POST',
				url: 'controller/class/database/oc_enrollment_requirement.php',
				data: {schlacadyrlvl_id:getAcademicYearLevelID,schlacadlvl_id:getAcademicLevelID},
				success: function(data){
					$("#loader").hide();
					$("#registration-requirements").html(data);
				}
			});
		});
		$("#academicyearlevel-list").ready(function(){
			var getAcademicYearLevelID = $(this).val();
			var getAcademicLevelID = $("#academiclevel-list").val();
			$.ajax({
				type:'GET',
				url: 'controller/class/database/school_academic_course.php',
				data: {schlacadyrlvl_id:getAcademicYearLevelID,schlacadlvl_id:getAcademicLevelID},
				success: function(data){
					$("#academiccourse-data").html(data);
				}
			});
			$("#loader").show();
			$.ajax({
				type:'POST',
				url: 'controller/class/database/oc_enrollment_requirement.php',
				data: {schlacadyrlvl_id:getAcademicYearLevelID,schlacadlvl_id:getAcademicLevelID},
				success: function(data){
					$("#loader").hide();
					$("#registration-requirements").html(data);
				}
			});
		});
	});
</script>