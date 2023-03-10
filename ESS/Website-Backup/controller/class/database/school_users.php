<?php 
	//session_start();
	require_once('../configuration/connection.php');
	$username = mysqli_real_escape_string($dbConn,$_POST['username']);
	$password = mysqli_real_escape_string($dbConn,$_POST['password']);

if ($username != "" && $password != ""){
	/* $qry = "SELECT `schlusr_id` `USER_ID`, 
						  `schlusr_username` `USER_NAME`, 
						  `schlusr_status` `STATUS`, 
						  `schlusr_isactive` `IS_ACTIVE`, 
						  `schlusr_user_id` `EMP_ID`,
						  `schlusr_lname` `LAST_NAME`,
						  `schlusr_fname` `FIRST_NAME`,
						  `schlusr_mname` `MIDDLE_NAME`,
						  `schlusr_acclvl` `ACC_LVL`
						From `school_users`
							WHERE `schlusr_username` = '".$username."' AND `schlusr_password` = MD5('".$password."')"; */
	$qry = "SELECT COUNT(`schlusr_id`) `CNT`,`schlusr_id` `USER_ID`,`schlusr_acclvl` `ACC_LVL`
				From `school_users`
					WHERE `schlusr_status` = 1 AND `schlusr_isactive` = 1 
							AND `schlusr_username` = '".$username."' AND `schlusr_password` = MD5('".$password."')";
							
	$result = mysqli_query($dbConn,$qry);
    $row = mysqli_fetch_array($result);
    $count = $row['CNT'];
	$userid = $row['USER_ID'];
	$acclvl = $row['ACC_LVL'];
    if($count == 0){
		echo 0;//Invalid Username and Password
	} else {
		//$_SESSION['USER_ID'] = $userid;
		//$_SESSION['ACC_LVL'] = $acclvl;
		echo $userid.'&acclvl='.$acclvl;//Valid User Account
		//echo $userid;
	} 
	mysqli_close($dbConn);
}
?>
