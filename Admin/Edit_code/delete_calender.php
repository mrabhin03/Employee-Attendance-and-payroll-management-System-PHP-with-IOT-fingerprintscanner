<?php
include '../common/connection.php';
    $data=$_GET['id'];
    $update="DELETE FROM company_calender WHERE Month_id='$data'";
    $con->query($update);
    echo "<script>window.location.href = 'Index.php?page=calendar';</script>";
?>