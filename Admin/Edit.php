<?php
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
                <tr>
                    <td>
                        <label for="desig" >Designation</label>
                    </td>
                    <td>
                    <select  name="desc_name"required>
                        <?php 
                        $ds=$EMP['Desc_id'];
                          $sql = "SELECT * FROM employee_designation WHERE  Desc_id != '$ds'";
                          $sql1 = "SELECT * FROM employee_designation WHERE  Desc_id = '$ds'";
                          $query = $con->query($sql);
                          $query1 = $con->query($sql1);
                          $data=$query1->fetch_assoc();
                          echo "<option value='$ds' selected>".$data['Desc_name']."</option>";
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['Desc_id']."'>".$prow['Desc_name']."</option>
                            ";
                          }
                        ?>
                  </select>
                    </td>
                </tr>
                <tr class="footer_tr">
                    <td colspan="2">
                        <div class="Edit_footer">
                            <?php echo "<a href='?page=View_details&id=$data_id'><button  type='button' class='cancel_edit' >Close</button></a>" ?>
        	                <button type="submit" class="save_edit" name="update" > Update</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    include 'update_code.php';
?>