<?php

// $dbConn = mysqli_connect('localhost', 'root', '', 'fcpc'); // FOR LOCAL

// $dbConn = mysqli_connect('localhost', 'dbessportal', 'FCPCsince1984', 'fcpconlinecampus'); // FOR SERVER 

$dbConn = mysqli_connect('184.168.101.93', 'dbocofficeuser', 'FCPCsince1984', 'fcpconlinecampus'); // FOR CONNECTING TO LIVE DATABASE


if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>