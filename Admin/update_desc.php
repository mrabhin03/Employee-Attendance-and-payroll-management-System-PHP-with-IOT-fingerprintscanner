<div class="addempin">
    <?php
    $id=$_GET['id'];
    include '../common/connection.php';
    $numbers='';
    for($i = 0; $i < 10; $i++){
        $numbers .= $i;
    }
    $descid = substr(str_shuffle($numbers), 0, 5);
    $desc_details = "SELECT * FROM employee_designation WHERE Desc_id='$id'";
    $datavalue= $con->query($desc_details);
    $test = "SELECT * FROM employee_designation WHERE Desc_id='$descid'";
    $data= $con->query($test);
    while ($data->num_rows != 0) {
        $descid =   substr(str_shuffle($numbers), 0, 5);
        $test = "SELECT * FROM employee_designation WHERE Desc_id='$descid'";
        $data = $con->query($test);
    }
    $row= $datavalue->fetch_assoc();

    ?>
    <form method="POST">
        <div class="main_form">
            <div class="desc_details">
                <h1 style="text-align:center;">Designation Details</h1>
                <div class="form_div">
                    <label for="username">Designation ID</label>
                    <input type="text" id="user" value="<?php echo $row['Desc_id']; ?>" name="Descid" readonly required>
                </div>
                <div class="form_div">
                    <label for="descname">Designation name</label>
                    <input type="text" id="name" name="descname" value="<?php echo $row['Desc_name']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="salary">Basic salary</label>
                    <input type="text" id="salary" name="salary" value="<?php echo $row['Desc_basic']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="da">Dearness allowance</label>
                    <input type="text" id="da" name="da" value="<?php echo $row['Desc_da']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="ma">Medical allowance</label>
                    <input type="text" id="ma" name="ma" value="<?php echo $row['Desc_ma']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="pf">Provident fund</label>
                    <input type="text" id="pf" name="pf" value="<?php echo $row['Desc_pf']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="inc">Increment</label>
                    <input type="text" id="inc" name="inc" value="<?php echo $row['Desc_inc']; ?>" required>
                </div>
                <div class="add_footer">
                    <a href="?page=Designations"><button type="button" class="cancel_insert">Close</button></a>
                    <button type="submit" name="update_desc" class="save"> Add</button>
                </div>
            </div>
            <?php
            	if(isset($_POST['update_desc'])){
                    $desc_id = $_POST['Descid'];
                    $descname = $_POST['descname'];
                    $salary = $_POST['salary'];
                    $da = $_POST['da'];
                    $ma = $_POST['ma'];
                    $pf = $_POST['pf'];
                    $inc = $_POST['inc'];
                    $sql_update="UPDATE employee_designation SET Desc_id='$descid',Desc_status=0 WHERE Desc_id='$desc_id'";
                    $con->query($sql_update);
                    $sql = "INSERT INTO employee_designation (Desc_id, Desc_name, Desc_basic, Desc_da, Desc_ma, Desc_pf, Desc_inc, Desc_status) VALUES ('$desc_id','$descname','$salary','$da','$ma','$pf','$inc',1)";
                    $con->query($sql);
                    echo "<script>window.location.href = '?page=Designations';</script>";
                }

?>
            
        </div>
    </form>
</div>