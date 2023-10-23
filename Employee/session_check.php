<?php
session_start();

if(!isset($_SESSION['Emp_id'])) {
    header("Location: ../login/login.php");
    exit();
}
?>
