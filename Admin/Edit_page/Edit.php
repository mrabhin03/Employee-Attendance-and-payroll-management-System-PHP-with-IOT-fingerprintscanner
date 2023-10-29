<?php
include 'session_check.php';
    include '../common/connection.php';
    $data_id=$_GET['id'];
    $query="SELECT * FROM employee_details WHERE Emp_id='$data_id'";
    $data=$con->query($query);
    $EMP = $data->fetch_assoc();
?>
<div class="edit_div">
    <div class="data">
        <form method="POST" enctype="multipart/form-data">
            <h2>EDIT DETAILS</h2>
            <table class="edit_table">
            <tr>
                    <td>
                        <label for="Username">Username</label>
                    </td>
                    <td>
                        <input type="text" id="name" name="Username" value="<?php echo $EMP['Emp_id'];?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="fullname">Full name</label>
                    </td>
                    <td>
                        <input type="text" id="name" name="fullname" value="<?php echo $EMP['Emp_name'];?>"required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input type="text" id="email" name="email" value="<?php echo $EMP['Emp_email'];?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="address" >Address</label>
                    </td>
                    <td>
                        <input type="text" id="address" value="<?php echo $EMP['Emp_Address'];?>" name="address" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="gender" >Mobile no</label>
                    </td>
                    <td>
                        <input type="text" id="mobile" value="<?php echo $EMP['Emp_mobileno'];?>" name="mobile">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="photo" >Photo</label>
                    </td>
                    <td>
                        <input value="<?php echo $EMP['Emp_Photo'];?>" style="width:200px" type="file" name="photo" id="photo">
                    </td>
                </tr>
                <tr class="footer_tr">
                    <td colspan="2">
                        <div class="Edit_footer">
                            <?php echo "<a href='?page=View_details&id=$data_id'><button  type='button' class='cancel_edit' >Close</button></a>" ?>
        	                <button type="submit" class="save_edit" name="update" >Update</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    include '../Edit_code/update_code.php';
    if(isset($_POST['update'])){
        $empid = $_POST['Username'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $filename = $_FILES['photo']['name'];
        
        if(!empty($filename)){
            move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
            $sqldata = "UPDATE employee_details SET Emp_name='$fullname',Emp_Address='$address',Emp_mobileno='$mobile',Emp_email='$email', Emp_Photo='$filename' WHERE Emp_id='$empid'";
        }
        else
        {
            $sqldata = "UPDATE employee_details SET Emp_name='$fullname',Emp_Address='$address',Emp_mobileno='$mobile',Emp_email='$email' WHERE Emp_id='$empid'";
        }
        
        $con->query($sqldata);
        echo "<script>window.location.href = '?page=View_details&id=$empid';</script>";
    }
?>