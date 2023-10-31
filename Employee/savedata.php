<?php
include 'session_check.php';
include '../common/connection.php';
$id=$_POST['Username'];
$name=$_POST['fullname'];
$address=$_POST['address'];
$DOB=$_POST['DOB'];
$mobile=$_POST['mobile'];
$gender=$_POST['gender'];
$filename = $_FILES['photo']['name'];
if(!empty($filename)){
    move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
}
$update="UPDATE employee_details SET Emp_name='$name',gender='$gender',Emp_Address='$address',Emp_DOB='$DOB', Emp_mobileno='$mobile',Emp_Photo='$filename'WHERE Emp_id='$id'";
$con->query($update);
echo "<script>window.location.href = 'index.php';</script>";
?>