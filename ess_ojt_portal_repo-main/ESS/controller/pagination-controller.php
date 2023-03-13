<?php
    echo '<li class="page-item"><a class="page-link" href="'. $_SESSION['DASHBOARD'].'?page=1">First</a></li>';
    echo '<li class="page-item"><a class="page-link" href="'. $_SESSION['DASHBOARD'].'?page=previous">Previous</a></li>';
    for($i = -3; $i <= 3; $i++){
        $number = $page + $i;
        if($number > 0 && $number <= $number_of_page){
            echo '<li class="page-item"><a class="page-link" href="'. $_SESSION['DASHBOARD'].'?page='. $number .'">'. $number .'</a></li>';
        }
    }
    echo '<li class="page-item"><a class="page-link" href="'. $_SESSION['DASHBOARD'].'"?page=next">Next</a></li>';
    echo '<li class="page-item"><a class="page-link" href="'. $_SESSION['DASHBOARD'].'?page=last">Last</a></li>';
?>