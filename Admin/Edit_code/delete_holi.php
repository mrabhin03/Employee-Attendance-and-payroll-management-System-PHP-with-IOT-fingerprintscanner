<?php
include 'session_check.php';
include '../common/connection.php';
    $day=$_GET['day'];
    $mid=$_GET['mid'];
    $delete_holi="DELETE FROM holidays WHERE day='$day' AND Month_id='$mid'";
    $con->query($delete_holi);
    echo "<script>window.location.href = 'Index.php?page=Holidays';</script>";
?>