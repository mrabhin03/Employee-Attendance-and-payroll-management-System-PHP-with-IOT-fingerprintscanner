<?php
if(isset($_POST['save_holi'])){
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $month=$month+1;
    $monthtm = str_pad($month, 2, "0", STR_PAD_LEFT);
    $month_id=$year.$monthtm;
    echo "".$month_id." Month".$month."  Day".$day;
    $sql="INSERT INTO holidays(Month_id,day) VALUES ('$month_id','$day')";
    $con->query($sql);
    echo "<script>window.location.href = '?page=Holidays';</script>";
}
?>