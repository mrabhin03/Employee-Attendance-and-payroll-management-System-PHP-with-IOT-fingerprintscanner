<?php
include '../common/connection.php';
if(isset($_POST['update'])){
    $empid = $_POST['Username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $dob = $_POST['DOB'];
    $mobile = $_POST['mobile'];
    $filename = $_FILES['photo']['name'];
    $des_id = $_POST['desc_name'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
        $sql = "UPDATE employee_details SET Emp_name='$fullname',Desc_id='$des_id',Emp_Address='$address',Emp_mobileno='$mobile',Emp_email='$email',Emp_Photo='$filename' WHERE Emp_id=$empid";	
    }
    else
    {
        $sql = "UPDATE employee_details SET Emp_name='$fullname',Desc_id='$des_id',Emp_Address='$address',Emp_mobileno='$mobile',Emp_email='$email' WHERE Emp_id=$empid";
    }
    $con->query($sql);
    /*echo "<script>window.location.href = '?page=View_details&id=$empid';</script>";*/
}

?>