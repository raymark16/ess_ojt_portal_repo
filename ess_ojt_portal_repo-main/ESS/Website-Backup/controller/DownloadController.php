<?php 
$FILE_UPLOADED_PATH = $_SERVER['DOCUMENT_ROOT'].'/Code/online-campus/UPLOADS/';

$file_url = $FILE_UPLOADED_PATH . $_GET['file_location'];

// echo $FILE_UPLOADED_PATH . $file_url;
if (file_exists($file_url)) {
    header('Content-Type: image/jpg');
    header("Content-Transfer-Encoding: Binary"); 
    header('Content-Length: '.filesize($file_url));
    header('Content-Disposition: attachment; filename="'.basename($file_url).'"' );
    echo readfile($file_url); 
    }
?>