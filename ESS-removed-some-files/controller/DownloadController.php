<?php 
    session_start();

    include 'class/configuration/connection.php';

    if(isset($_GET['id']))
    {

        $qry = "SELECT * FROM oc_uploaded_documents WHERE document_id = " . $_GET['id'];
        $rsuser = $dbConn->query($qry);
        $file_info = $rsuser->fetch_ALL(MYSQLI_ASSOC);

        $file = $file_info[0];

        print_r($file);

        $fileName = basename($file['document_location']); 

        $filePath = $file['document_location'];

        echo $fileName;

        if(!empty($fileName) && file_exists($filePath)){ 
            // Define headers 
            header("Cache-Control: public"); 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$fileName"); 
            header("Content-Type: application/octet-stream"); 
            header("Content-Transfer-Encoding: binary"); 
            header('Expires: 0');        
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            ob_clean();
            flush();
            // Read the file 
            readfile($filePath); 
            // exit; 
        }
    }


 
?>