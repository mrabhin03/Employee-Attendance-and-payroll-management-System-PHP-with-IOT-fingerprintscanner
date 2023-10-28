<?php
                include '../common/connection.php';
            	if(isset($_POST['add'])){
                    $empid = $_POST['Username'];
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
                        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
                    }
                    $numbers = '';
                    for($i = 0; $i < 10; $i++){
                        $numbers .= $i;
                    }
                    
                    $letters1 = '';
                    $letters2 = '';
                    $special = [ '@', '#', '$', '%',  '&', '*'];
                    

                    foreach (range('A', 'Z') as $char) {
                        $letters1 .= $char;
                    }
                    foreach (range('a', 'z') as $char) {
                        $letters2 .= $char;
                    }

                    // Ensure at least 1 character from each set
                    $password = $letters1[rand(0, 25)] . $letters2[rand(0, 25)] . $special[rand(0, count($special) - 1)] . $numbers[rand(0, 9)];

                    $remainingCharacters = $letters1 . $letters2 . implode('', $special) . $numbers;
                    $password .= substr(str_shuffle($remainingCharacters), 0, 6);

                    // Shuffle the password
                    $passwordtmp = str_shuffle($password);
                    $password = password_hash($passwordtmp, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO employee_details(Emp_id, Emp_password, Emp_name, Gender, Desc_id, Emp_address, Emp_DOB, Emp_DOJ, Emp_mobileno, Emp_email, Emp_photo, Emp_status) VALUES ('$empid','$password','$fullname','$gender','$des_id','$address ','$dob','$doj','$mobile','$email','$filename',1)";
                    $sql1="INSERT INTO designation_for_employee(Emp_id, Desc_id, Desc_from_date, Desc_to_date, Desc_status) VALUES ('$empid','$des_id','$desfrom','$desto',1)";
                    $con->query($sql);
                    $con->query($sql1);
                    
                    session_start(); // Start the session
                    $_SESSION['email'] = $email;
                    $_SESSION['passwordtmp'] = $passwordtmp;
                    $_SESSION['fullname'] =$fullname;
                    $_SESSION['empid'] = $empid;
                    header('location:../../phpmailer/index.php');
                }
