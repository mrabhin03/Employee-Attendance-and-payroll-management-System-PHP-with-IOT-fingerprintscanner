<?php
$hostname="localhost";
$username="root";
$password="";
$db="miniproject";
$con=mysqli_connect($hostname,$username,$password,$db);

if(!$con){
    header("location:Error.php");
}
?>