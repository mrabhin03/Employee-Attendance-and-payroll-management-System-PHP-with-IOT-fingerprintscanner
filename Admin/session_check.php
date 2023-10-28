<?php
session_start();

if(!isset($_SESSION['Admin_id'])) {
    header("Location: ../login/login.php");
    exit();
}
?>
