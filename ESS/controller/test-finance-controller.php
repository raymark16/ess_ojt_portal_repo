<?php
    session_start();
    if(!isset($_SESSION["USERID"])){
        header("Location: ../Login.php");
        exit();
    }
    
    if (isset($_GET['logout'])) 
    {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['position']);
        header('location: ../login.php');
        exit();
    }
    include('controller/class/configuration/connection.php');
        
    $qryreg = " SELECT `ocuser`.`registration_date` `REG_DATE`, 
            UPPER(CONCAT(`ocuser`.`last_name`, ', ', `ocuser`.`first_name` , ' ' , `ocuser`.`middle_name`)) `NAME`,
            UPPER(`ocuser`.`student_type`)`STUDENT_TYPE`,
            UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
            UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
            UPPER(`crse`.`schlacadcrse_code`) `CRSE_NAME`, 
            `reg`.`schlusr_id` `USER_ID`,
            `reg`.`schlenrollprereg_id` `REG_ID`,
            `ocuser`.`id` `OC_USER_ID`,
            `reg`.`schlenrollprereg_verification` `REG_STATUS`, 
            `ocuser`.`verified` `OC_STATUS` 

    FROM `oc_user_accounts` `ocuser`
        LEFT JOIN `school_enrollment_pre_registration` `reg`
            ON `reg`.`schlenrollprereg_emailadd` = `ocuser`.`emailaddress`
        LEFT JOIN `school_academic_level` `lvl`
            ON  `reg`.`acadlvl_id`=`lvl`.`schlacadlvl_id`
        LEFT JOIN `school_academic_year_level` `yrlvl`
            ON  `reg`.`acadyrlvl_id`=`yrlvl`.`schlacadyrlvl_id`
        LEFT JOIN `school_academic_course` `crse`
            ON  `reg`.`acadcrse_id`=`crse`.`schlacadcrse_id`
        LEFT JOIN `school_users` `usr`
            ON  `reg`.`schlusr_id`=`usr`.`schlusr_id`

    WHERE   `reg`.`schlenrollprereg_verification` >= 2 OR `ocuser`.`student_type` = 'payment_only'

    ORDER BY    `ocuser`.`registration_date` DESC,
                `ocuser`.`verified` DESC,
                `reg`.`schlenrollprereg_regdate` DESC,
                `reg`.`schlenrollprereg_verification` DESC";
                            
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

    $qryreg = "
    SELECT `ocuser`.`registration_date` `REG_DATE`, 
            UPPER(CONCAT(`ocuser`.`last_name`, ', ', `ocuser`.`first_name` , ' ' , `ocuser`.`middle_name`)) `NAME`,
            UPPER(`ocuser`.`student_type`)`STUDENT_TYPE`,
            UPPER(`lvl`.`schlacadlvl_name`) `LVL_NAME`, 
            UPPER(`yrlvl`.`schlacadyrlvl_name`) `YRLVL_NAME`, 
            UPPER(`crse`.`schlacadcrse_code`) `CRSE_NAME`, 
            `reg`.`schlusr_id` `USER_ID`,
            `reg`.`schlenrollprereg_id` `REG_ID`,
            `ocuser`.`id` `OC_USER_ID`,
            `reg`.`schlenrollprereg_verification` `REG_STATUS`, 
            `ocuser`.`verified` `OC_STATUS` 

    FROM `oc_user_accounts` `ocuser`
        LEFT JOIN `school_enrollment_pre_registration` `reg`
            ON `reg`.`schlenrollprereg_emailadd` = `ocuser`.`emailaddress`
        LEFT JOIN `school_academic_level` `lvl`
            ON  `reg`.`acadlvl_id`=`lvl`.`schlacadlvl_id`
        LEFT JOIN `school_academic_year_level` `yrlvl`
            ON  `reg`.`acadyrlvl_id`=`yrlvl`.`schlacadyrlvl_id`
        LEFT JOIN `school_academic_course` `crse`
            ON  `reg`.`acadcrse_id`=`crse`.`schlacadcrse_id`
        LEFT JOIN `school_users` `usr`
            ON  `reg`.`schlusr_id`=`usr`.`schlusr_id`

    WHERE   `reg`.`schlenrollprereg_verification` >= 2 OR `ocuser`.`student_type` = 'payment_only'

    ORDER BY    `ocuser`.`registration_date` DESC,
                `ocuser`.`verified` DESC,
                `reg`.`schlenrollprereg_regdate` DESC,
                `reg`.`schlenrollprereg_verification` DESC

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