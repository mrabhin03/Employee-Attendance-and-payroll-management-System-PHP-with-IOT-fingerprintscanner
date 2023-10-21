<?php
if(isset($_POST['save_cal'])){
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $month=$month+1;
    $sql="INSERT INTO company_calender(Year, Month, Working_day) VALUES ('$year','$month','$day')";
    $con->query($sql);
    echo "<script>window.location.href = '?page=calendar';</script>";
}
?>