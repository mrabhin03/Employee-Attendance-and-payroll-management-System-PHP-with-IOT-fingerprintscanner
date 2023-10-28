<div class="addempin">
<div  class="thefulldiv">
  <div class="loading">
    <div class="bar1"></div>
    <div class="bar2"></div>
    <div class="bar3"></div>
    <h2>Please wait till <br> The Account is created</h2>
  </div>
</div>
    <?php
    if(isset($_POST["add"]) )
    {
        echo " <script>const loading = document.querySelector('.loading');
        const areyou = document.querySelector('.thefulldiv'); 
        areyou.classList.add('active');
        loading.classList.add('active');</script>";
    }
    include '../common/connection.php';
    $check="SELECT MAX(CAST(SUBSTRING(Emp_id, 2) AS SIGNED)) AS MAX_VALUE FROM employee_details;";
    $data=$con->query($check);
    $count=$data->fetch_assoc();
    $empid="E".$count['MAX_VALUE']+1;
    ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="main_form">
            <div class="emp_details">
                <h1 style="text-align:center;">Employee Details</h1>
                <div class="form_div">
                    <label for="username">Username</label>
                    <input type="text" id="user" value="<?php echo $empid ?>" name="Username" readonly required>
                </div>
                <div class="form_div">
                    <label for="fullname">Full name</label>
                    <input type="text" id="name" name="fullname" required>
                </div>
                <div class="form_div">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form_div">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address">
                </div>
                <div class="form_div">
                    <label for="DOB">Date of Birth</label>
                    <input type="date" id="dob" name="DOB">
                </div>
                <div class="form_div">
                    <label for="gender">Mobile no</label>
                    <input type="text" id="mobile" name="mobile">
                </div>
                <div class="form_div" style="width: 25%; align-items:center;">
                    <label for="gender" id="gender">Gender</label>
                    <input type="radio" value="Male" name="gender">Male
                    <input type="radio" value="Female" name="gender">Female
                </div>
                <div class="form_div">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo">
                </div>
                <div class="add_footer">
                    <a href="?page=Employees"><button type="button" class="cancel_insert">Close</button></a>
                    <button onclick="checkvalid()" type="button" class="next"> Next</button>
                    <script src="javascript/Functions.js"></script>
                </div>
            </div>

            <div class="designation_add">

                <h4 class="modal-title" style="text-align: center;"><b>Designation Details</b></h4>
                <div class="form_div">
                    <label for="DOJ">Date of Join</label>
                    <input type="date" name="DOJ" required>
                </div>
                <div class="form_div">
                    <label for="Desig">Desgnation</label>
                    <select name="desc_name" required>
                        <option value="" selected>- Select -</option>
                        <?php
                        $sql = "SELECT * FROM employee_designation WHERE Desc_status=1";
                        $query = $con->query($sql);
                        while ($prow = $query->fetch_assoc()) {
                            echo "
                              <option value='" . $prow['Desc_id'] . "'>" . $prow['Desc_name'] . "</option>
                            ";
                        }
                        ?>
                    </select>
                </div>
                <div class="form_div">
                    <label for="Desig_from">Designation From</label>
                    <input type="date" name="Des_from" required>
                </div>
                <div class="form_div">
                    <label for="Desig_to">Designation To</label>
                    <input type="date" name="Des_to" required>
                </div>
                <div class="add_footer">
                    <button onclick="add_new_page()" type="button" class="back">Back</button>
                    <button type="submit" name="add" class="save"> Add</button>
                </div>
            </div>
            <?php
            include 'Edit_code/addempp.php';
            ?>
        </div>
    </form>
</div>