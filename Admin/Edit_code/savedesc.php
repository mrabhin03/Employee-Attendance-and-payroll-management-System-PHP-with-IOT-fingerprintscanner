<?php
                include '../common/connection.php';
            	if(isset($_POST['save_desc'])){
                    $descid = $_POST['Descid'];
                    $descname = $_POST['descname'];
                    $salary = $_POST['salary'];
                    $da = $_POST['da'];
                    $ma = $_POST['ma'];
                    $pf = $_POST['pf'];
                    $inc = $_POST['inc'];
                    $sql = "INSERT INTO employee_designation (Desc_id, Desc_name, Desc_basic, Desc_da, Desc_ma, Desc_pf, Desc_inc, Desc_status) VALUES ('$descid','$descname','$salary','$da','$ma','$pf','$inc',1)";
                    $con->query($sql);
                    echo "<script>window.location.href = '?page=Designations';</script>";
                }

?>
            