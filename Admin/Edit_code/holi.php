<?php
include 'session_check.php';
include '../common/connection.php';
    $day=$_GET['day'];
    $mid=$_GET['id'];
    $st=$_GET['st'];
    $yeart1 = substr($mid, 0, 4);
    $montht1 = substr($mid, 4, 2);
    $datedata=$yeart1.'-'.$montht1;
    $comp="SELECT * FROM company_calender WHERE Month_id='$mid'";
    $data=$con->query($comp);
        $datafe=$data->fetch_assoc();
        $dayvalue=$datafe['Working_day'];
        if($st==0){
            $sql="DELETE FROM holidays WHERE day='$day' AND Month_id='$mid'";
            $dayvalue=$dayvalue+1;
        }
        else
        {
            $sql="INSERT INTO holidays(Month_id,day) VALUES ('$mid','$day')";
            $dayvalue=$dayvalue-1;
        }
        $update="UPDATE company_calender SET Working_day='$dayvalue' WHERE Month_id='$mid'";
        $con->query($update);
        $con->query($sql);
        echo "<script>window.location.href = 'Index.php?page=Calendar&date=$datedata';</script>";
    
?>