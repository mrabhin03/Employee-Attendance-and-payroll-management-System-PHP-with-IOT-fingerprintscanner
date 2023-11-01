<?php
include 'session_check.php';
$uid=$_GET['id'];
$option=$_GET['va'];
$position = strpos($uid, 'E');
if ($position !== false) {
    $result = substr($uid, $position);
}
if($option==1)
{
    $data1="UPDATE employee_details
    SET Emp_name = (SELECT Emp_name FROM employee_details WHERE Emp_id = '$uid'),
        gender = (SELECT gender FROM employee_details WHERE Emp_id = '$uid'),
        Emp_Address = (SELECT Emp_Address FROM employee_details WHERE Emp_id = '$uid'),
        Emp_DOB = (SELECT Emp_DOB FROM employee_details WHERE Emp_id = '$uid'),
        Emp_mobileno = (SELECT Emp_mobileno FROM employee_details WHERE Emp_id = '$uid'),
        Emp_Photo = (SELECT Emp_Photo FROM employee_details WHERE Emp_id = '$uid'),
        Emp_status = '1'
    WHERE Emp_id = '$result'";
    $data2="UPDATE employee_details SET Emp_status='100' WHERE  Emp_id = '$uid'";
    $con->query($data1);
    $con->query($data2);
}
else
{
    $data1="UPDATE employee_details SET Emp_status='3' WHERE  Emp_id = '$result'";
    $data2="DELETE FROM employee_details WHERE  Emp_id = '$uid'";
    $con->query($data2);
    $con->query($data1);
    
}
echo "<script>window.location.href = 'index.php?page=Notifications';</script>";
?>