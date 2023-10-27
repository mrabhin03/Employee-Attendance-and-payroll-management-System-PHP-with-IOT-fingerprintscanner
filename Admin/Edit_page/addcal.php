<div class="addcal">
    <?php

    include '../common/connection.php';
    $month=array("January","February","March","April","May","June","July","August","September","October","November","December");
    ?>
    <form method="POST">
        <div class="main_form">
        <div class="emp_details">
                <h1 style="text-align:center;">Calendar Details</h1>
                <div class="form_div">
                    <label for="year">Year</label>
                    <select name="year" id="year" required>
                    <option value="">-Select-</option>
                        <?php
                        for($i=2022;$i<=2040;$i++)
                        {
                            echo "<option value=".$i.">".$i."</option>";
                        } 
                        ?>
                    </select>
                </div>
                <div class="form_div">
                    <label for="Month">Month</label>
                    <select name="month" id="mo" required>
                    <option value="">-select-</option>
                    <?php
                        for($i=0;$i<12;$i++)
                        {
                            echo "<option value=".$i.">".$month[$i]."</option>";
                        } 
                        ?>
                    </select>
                </div>
                <div class="form_div">
                    <label for="day">Days</label>
                    <input type="text" name="day" required>
                </div>
                <div class="add_footer">
                    <a href="?page=Calendar"><button type="button" class="cancel_insert">Close</button></a>
                    <button type="submit" name="save_cal" class="save"> Add</button>
                </div>
            </div>
            <?php
            include 'Edit_code/save_cal.php';
            ?>
        </div>
    </form>
</div>