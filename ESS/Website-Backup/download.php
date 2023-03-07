<?php 
 session_start();

if(isset($_GET['file']))
{
    // Define file name and path 
        $fileDir  = $_SESSION['dir'];
        $fileName = $_GET['file']; 

        //$fileName = str_replace(' ', '', $fileName);

        // FILEPATH FOR LIVE WEBSITE
        $filePath = '/home/zstvqx3gf3b4/public_html/onlinecampus.fcpc-inc.com/Code/online-campus/UPLOADS/'. $fileDir.'/'.$fileName; 

        //echo $fileName; 
        echo $filePath;

        // FILEPATH FOR LOCAL WEBSITE
/*        $filePath = $dir.'\\'.$file;*/


 
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
        exit; 
    }
    else
    {   

        echo "<script type='text/javascript'>alert('The File does not Exist.')</script>";
        echo "<script type='text/javascript'>location.href='".$_SESSION['LINK']."'</script>";

    } 

}


 
?>