<?php

// $dbConn = mysqli_connect('localhost', 'root', '', 'fcpc'); // FOR LOCAL

$dbConn = mysqli_connect('localhost', 'dbessportal', 'FCPCsince1984', 'fcpconlinecampus');

if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>