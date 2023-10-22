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
                    <select name="month" id="mo" onchange="updateDays()" onclick="checkentrydate()" required>
                    <option value="">-select-</option>
                    <?php
                        for($i=0;$i<12;$i++)
                        {
                            echo "<option value=".$i.">".$month[$i]."</option>";
                        } 
                        ?>
                    </select>
                    <script>
                        function updateDays() {
                            const monthSelect = document.getElementById("mo");
                            const yearInput = document.getElementById("year");
                            const daySelect = document.getElementById("day");
                            daySelect.innerHTML = ""; // Clear previous options

                            const selectedMonth = parseInt(monthSelect.value, 10);
                            const selectedYear = parseInt(yearInput.value, 10);
                            const daysInMonth = new Date(selectedYear, selectedMonth + 1, 0).getDate();

                            for (let day = 1; day <= daysInMonth; day++) {
                                const option = document.createElement("option");
                                option.value = day;
                                option.text = day;
                                daySelect.appendChild(option);
                            }
                        }
                        updateDays();
                        function checkentrydate()
                        {
                            const monthSelect = document.getElementById("mo");
                            const yearInput = document.getElementById("year");
                            if(yearInput.value!="")
                            {
                                yearInput.style.borderColor='#d2d6de';
                                if(monthSelect.value!="")
                                {
                                    monthSelect.style.borderColor='#d2d6de';
                                }
                                else
                                {
                                    monthSelect.style.borderColor='red';
                                }
                            }
                            else
                            {
                                yearInput.style.borderColor='red';
                            }
                        }
                    </script>
                </div>
                <div class="form_div">
                    <label for="day">Day</label>
                    <select name="day" id="day" onclick="checkentrydate()" required>
                        <option value="">-Select-</option>
                    </select>
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