<?php
                include '../common/connection.php';
            	if(isset($_POST['add'])){
                    $empid = $_POST['Username'];
                    $password = $_POST['Password'];
                    $fullname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $dob = $_POST['DOB'];
                    $mobile = $_POST['mobile'];
                    $gender = $_POST['gender'];
                    $filename = $_FILES['photo']['name'];
                    $doj = $_POST['DOJ'];
                    $des_id = $_POST['desc_name'];
                    $desfrom = $_POST['Des_from'];
                    $desto = $_POST['Des_to'];
                    if(!empty($filename)){
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$filename);	
                    }
                    for($i = 0; $i < 10; $i++){
                        $numbers .= $i;
                    }
                    $rfid = substr(str_shuffle($numbers), 0, 3);
                    $sql = "INSERT INTO employee_details(Emp_id, Emp_password, Emp_name, Gender, Desc_id, Emp_address, Emp_DOB, Emp_DOJ, Emp_mobileno, Emp_email, Rf_id, Emp_photo, Emp_status) VALUES ('$empid','$password','$fullname','$gender','$des_id','$address ','$dob','$doj','$mobile','$email','$rfid','$filename',1)";
                    $sql1="INSERT INTO designation_for_employee(Emp_id, Desc_id, Desc_from_date, Desc_to_date, Desc_status) VALUES ('$empid','$des_id','$desfrom','$desto',1)";
                    $con->query($sql);
                    $con->query($sql1);
                    echo "<script>window.location.href = '?page=Employees';</script>";
                }

            ?>
            