<?php
if(isset($_POST['save_cal'])){
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $month=$month+1;
    $monthtm = str_pad($month, 2, "0", STR_PAD_LEFT);
    $month_id=$year.$monthtm;
    $sql="INSERT INTO company_calender(Month_id,Year, Month, Working_day) VALUES ('$month_id','$year','$month','$day')";
    $con->query($sql);
    echo "<script>window.location.href = '?page=calendar';</script>";
}
?>