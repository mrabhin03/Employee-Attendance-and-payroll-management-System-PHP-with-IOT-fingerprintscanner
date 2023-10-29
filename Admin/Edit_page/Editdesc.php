<?php
    include '../common/connection.php';
    $data_id=$_GET['id'];
    $query="SELECT * FROM designation_for_employee WHERE Emp_id='$data_id' AND Desc_status='1'";
    $data=$con->query($query);
    $EMP = $data->fetch_assoc();
    $year=substr($EMP['Desc_to_date'], 0, 4);
    $month=substr($EMP['Desc_to_date'], 4);
    $date =  $year. '-' . $month;
    if($month>12)
    {
        $month=1;
        $month=sprintf("%02d", $month);
        $year=$year+1;
        $newdate=$year. '-' . $month;
    }
    else
    {
        $month=sprintf("%02d", $month+1);
        $newdate=$year. '-' . $month;
    }
?>
<div class="edit_div">
    <div class="data" style="height:370px; overflow: auto;">
        <form method="POST" onsubmit="return thesubmitfun();">
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
                        <label for="des_to">Old Designation to</label>
                    </td>
                    <td>
                        <input onchange="checktofromfirst()" type="month" id="oldto" name="olddes_to" value="<?php echo $date;?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="des_from">New Designation from</label>
                    </td>
                    <td>
                        <input type="month" id="newfrom" name="des_from" value="<?php echo $newdate;?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="des_to">New Designation to</label>
                    </td>
                    <td>
                        <input class="newuser" onchange="checktofromsec()" type="month" id="newto"  name="des_to" value="" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><label style="color:red;width:100%; text-align:center;"  id="not_valid"></label></td>
                </tr>
                <tr>
                    <td>
                        <label for="desc">New Designation</label>
                    </td>
                    <td>
                    <select   name="desc_id" required>
                        <?php 
                        $ds=$EMP['Desc_id'];
                          $sql = "SELECT * FROM employee_designation WHERE  Desc_id != '$ds0'  AND Desc_status!='0'";
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
        	                <button type="submit"  class="save_edit" name="update_desc" >Update</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    include '../Edit_code/update_code.php';
    if(isset($_POST['update_desc'])){
        $id=$_POST['Username'];
        $olddate_to=$_POST['olddes_to'];
        $date_from=$_POST['des_from'];
        $date_to=$_POST['des_to'];
        $desc_id=$_POST['desc_id'];
        $date_to = substr($date_to, 0, 4) . substr($date_to, 5);
        $date_from = substr($date_from, 0, 4) . substr($date_from, 5);
        $update="UPDATE designation_for_employee SET Desc_to_date='$olddate', Desc_status='0' WHERE Emp_id='$id' AND Desc_status='1'";
        $insert="INSERT INTO designation_for_employee (Emp_id, Desc_id, Desc_from_date, Desc_to_date, Desc_status) VALUES ('$id','$desc_id','$date_from',' $date_to','1')";
        $con->query($update);
        $con->query($insert);
        echo "<script>window.location.href = '?page=View_details&id=$id';</script>";
    }
?>