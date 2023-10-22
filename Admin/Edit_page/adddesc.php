<div class="addempin">
    <?php

    include '../common/connection.php';
    $numbers='';
    for($i = 0; $i < 10; $i++){
        $numbers .= $i;
    }
    $descid = substr(str_shuffle($numbers), 0, 5);

    $test = "SELECT * FROM employee_designation WHERE Desc_id='$descid'";
    $data = $con->query($test);
    while ($data->num_rows != 0) {
        $descid =   substr(str_shuffle($numbers), 0, 5);
        $test = "SELECT * FROM employee_designation WHERE Desc_id='$descid'";
        $data = $con->query($test);
    }

    ?>
    <form method="POST">
        <div class="main_form">
            <div class="desc_details">
                <h1 style="text-align:center;">Designation Details</h1>
                <div class="form_div">
                    <label for="username">Designation ID</label>
                    <input type="text" id="user" value="<?php echo $descid ?>" name="Descid" readonly required>
                </div>
                <div class="form_div">
                    <label for="descname">Designation name</label>
                    <input type="text" id="name" name="descname" required>
                </div>
                <div class="form_div">
                    <label for="salary">Basic salary</label>
                    <input type="text" id="salary" name="salary" required>
                </div>
                <div class="form_div">
                    <label for="da">Dearness allowance</label>
                    <input type="text" id="da" name="da" required>
                </div>
                <div class="form_div">
                    <label for="ma">Medical allowance</label>
                    <input type="text" id="ma" name="ma" required>
                </div>
                <div class="form_div">
                    <label for="pf">Provident fund</label>
                    <input type="text" id="pf" name="pf" required>
                </div>
                <div class="form_div">
                    <label for="inc">Increment</label>
                    <input type="text" id="inc" name="inc" required>
                </div>
                <div class="add_footer">
                    <a href="?page=Designations"><button type="button" class="cancel_insert">Close</button></a>
                    <button type="submit" name="save_desc" class="save"> Add</button>
                </div>
            </div>
            <?php
            include 'Edit_code/savedesc.php';
            ?>
        </div>
    </form>
</div>