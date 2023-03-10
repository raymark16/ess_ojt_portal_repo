<?php

$dbConn = mysqli_connect('localhost', 'dboc2022', 'FCPCsince1984', 'fcpconlinecampus');
//$dbConn = mysqli_connect('localhost', 'root', '', 'fcpc');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>