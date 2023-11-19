<?php
  include 'session_check.php';
  include '../common/connection.php';
  $currentmonth=date("Y-m");
  $monthid=date("Ym");
  $Year=date("Y");
  $month=date("m");
  $monthvalue=date("n");
  $id=$_SESSION['Emp_id'];
  $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  $monthdays = array(0,31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  ?>
<div class="EMP_HOME">
    <div style="display: flex; justify-content: space-between; z-index:1;" class="head">
        <div></div>
        <h3>Daily Attendance report </h3>
        <form method="post">
            <input style="border-radius:20px;" value="<?php
            if(isset($_POST['month_date']))
            {
                $date=$_POST['month_date'];
                list($Year,$month) = explode('-', $date);
                $monthvalue=intval($month);
            }
            $monthid=$Year.$month;
            $currentmonth=$Year.'-'.$month;
            echo $Year."-".$month;
            if (($Year % 4 == 0 && $Year % 100 != 0) || $Year % 400 == 0) {
              $monthdays[2]=29;
          }
        ?>" type="month" onchange="this.form.submit()" name="month_date" required>
        </form>

    </div>
    <div class="data1">
        <div class="sample_data">
            <div class="box">
                <div class="bodypart">
                    <?php
                        $sql = "SELECT Working_day FROM company_calender WHERE Month_id='$monthid'";
                        $query = $con->query($sql);
                        $calender_data=$query->fetch_assoc();
                        $total_days=$calender_data['Working_day'];
                    ?>
                    <h3 id="wrdays">0</h3>
                    <p>Total Working days</p>
                </div>
                <div class="footerpart">
                    <a href="">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <?php
                        $EMPsql = "SELECT * FROM employee_details WHERE Emp_id='$id';";
                        $empquery = $con->query($EMPsql);
                        $row = $empquery->fetch_assoc();
                        $rf=$row["Rf_id"];
                        $att_sql="SELECT COUNT(*) as Present FROM daily_attendance WHERE Att_date LIKE '$currentmonth%' AND Emp_id='$id' AND Att_status=1";
                        $present = $con->query($att_sql)->fetch_assoc();
                        $percentage = number_format(($present['Present']/$calender_data['Working_day'])*100,2);
                        $presentdata=$present['Present'];
                        $absent=$calender_data['Working_day']-$present['Present'];
                    ?>
                    <div
                        style=" margin-top:10px; width:100%; height:35px;display:flex; flex-direction: row; justify-content:center; align-item:center;">
                        <h3 style="font-size:30px; margin-top:0px;" id="perpre">0.00</h3><sup
                            style='font-size: 20px;'>%</sup>
                    </div>
                    <p>Total Present Percentage</p>
                </div>
                <div class="footerpart">
                    <a href="?page=attendace">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <h3 id="perpresen">0</h3>
                    <p>Total Presents</p>
                </div>
                <div class="footerpart">
                    <a href="?page=attendace">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <h3 id="perabsent">0</h3>
                    <p>Total Absents</p>
                </div>
                <div class="footerpart">
                    <a href="">More info</a>
                </div>
            </div>

        </div>
        <script>
            thespeed=0;
        function callassemble() {
            thespeed=100-<?php echo $percentage; ?>;
            autoin1();
            autoin2();
            autoin3();
            autoin4();
        }
        window.onload = function() {
            setTimeout(callassemble, 800);
        };

        function autoin1() {
            var j = 1;
            var anotherH1Element = document.getElementById('wrdays');

            function updateAnotherValue2() {
                if (j <= <?php echo $total_days; ?>) {
                    anotherH1Element.innerHTML = j;
                    j++;
                    setTimeout(updateAnotherValue2, 50);
                }
            }

            updateAnotherValue2();
        }
        var min = 10;
        var max = 99;

        function autoin2() {
            var j = 0;

            var anotherH1Element = document.getElementById('perpre');

            function updateAnotherValue1() {
                if (j <= <?php echo $percentage; ?>) {
                    var randomNum = Math.floor(Math.random() * (max - min + 1)) + min;
                    anotherH1Element.innerHTML = j + '.' + randomNum;
                    j++;
                    setTimeout(updateAnotherValue1, thespeed);
                } else {
                    if (<?php echo $percentage; ?> == 0) {
                        anotherH1Element.innerHTML = '0.00';
                    } else {
                        anotherH1Element.innerHTML = <?php echo $percentage; ?>;
                    }
                }
            }

            updateAnotherValue1();
        }

        function autoin3() {
            var j = 1;
            var anotherH1Element = document.getElementById('perpresen');

            function updateAnotherValue2() {
                if (j <= <?php echo $presentdata; ?>) {
                    anotherH1Element.innerHTML = j;
                    j++;
                    setTimeout(updateAnotherValue2, 70);
                }
            }

            updateAnotherValue2();
        }

        function autoin4() {
            var j = 1;
            var anotherH1Element = document.getElementById('perabsent');

            function updateAnotherValue3() {
                if (j <= <?php echo $absent; ?>) {
                    anotherH1Element.innerHTML = j;
                    j++;
                    setTimeout(updateAnotherValue3, 70);
                }
            }

            updateAnotherValue3();
        }
        </script>
        <div class="employee_att">
            <div class="att_sub_div1">
                <table style=' border-collapse: collapse;'>
                    <thead>
                        <th>SI</th>
                        <th>Date</th>
                        <th>Log in Time</th>
                        <th>Log out Time</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                        if($row['Emp_status'] !=1)
                        {
                          echo "<tr><td colspan='7' style='background-color: rgb(192, 19, 19); color:white;font-size:30px;'>SUSPENDED ACCOUNT</td></tr>";
                        }
                    if($empquery->num_rows>0)
                    {
                        $i=1;
                        $p=0;
                        $row = $query->fetch_assoc();
                      ?>
                        <?php
                      for($day= 1;$day<=$monthdays[$monthvalue];$day++)
                      {
                        if($day<10)
                        {
                            $currentdate=$currentmonth."-0".$day;
                        }
                        else
                        {
                            $currentdate=$currentmonth."-".$day;
                        }
                            $monthhliid = str_replace("-", "", $currentmonth);
                            $holidayquet="SELECT * FROM holidays WHERE Month_id='$monthhliid' AND day='$day'";
                            $holiday=$con->query($holidayquet)->num_rows;
                            $select1="SELECT emp_logs.*
                            FROM emp_logs 
                            LEFT JOIN employee_details ON employee_details.Rf_id = emp_logs.Rf_id
                            LEFT JOIN daily_attendance ON DATE(daily_attendance.Att_date) = DATE(emp_logs.Time_date) AND employee_details.Emp_id = daily_attendance.Emp_id
                            WHERE emp_logs.Rf_id = '$rf' 
                              AND DATE(emp_logs.Time_date) = '$currentdate'  
                              AND emp_logs.Log_status = 'IN'
                              AND daily_attendance.Att_date IS NOT NULL;";
                            $IN = $con->query($select1);
                            if($IN->num_rows> 0)
                            {
                              $att=1;
                              while($INrow = $IN->fetch_assoc())
                                {
                                    $INdata = date('H:i:s', strtotime($INrow['Time_date']));
                                    $select2="SELECT Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id=$rf AND Log_status='OUT'";
                                    $OUT = $con->query($select2);
                                    if($OUT->num_rows> 0)
                                    {
                                        $OUTrow = $OUT->fetch_assoc();
                                        $OUTdata = date('H:i:s', strtotime($OUTrow['Time_date']));
                                    }
                                    else
                                    {
                                        $OUTdata="---";
                                    }
                                }
                            }
                            else
                            {
                              $att=0;
                              $INdata="---";
                              $OUTdata="---";
                            }
                             if($holiday==0)
                            { 

                          ?>
                        <tr style="opacity: 0; z-index:0;font-size:17px;" id="<?php echo 'Home'.$i; ?>">
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $currentdate;?></td>
                            <td><?php echo $INdata; ?></td>
                            <td><?php echo $OUTdata; ?></td>
                            <td><?php  if($att==1)
                          {
                            echo "<p style='color: green;'>PRESENT</p>";
                            $p++;
                          } 
                          else
                          {
                            echo "<p style='color: red; font-weigth:none;'>ABSENT</p>";
                          } ?></td>
                        </tr>

                        <?php
                        }
                        else
                        {
                            echo"<tr id='Home$i' style='opacity: 0;background-color: rgb(192, 19, 19); color:white; border: 2px solid white;'>
                                    <td>$i</td>
                                    <td>$currentdate</td>
                                    <td colspan='6' ><p style=' font-size:20px; '>Public Holiday</p></td>
                                </tr>";
                            $i++;
                        }
                    }
                  }
                  else
                  {
                    ?>
                        <tr>
                            <td colspan="8">NO Data</td>
                        </tr>
                        <?php
                  }
                  $count=$i;
                  ?>
                    </tbody>
                </table>
                <script>
                trans();

                function trans() {
                    for (var i = 1; i < <?php echo $count; ?>; i++) {
                        var row = document.getElementById('Home' + i);
                        row.style.transform = "rotateX(90deg)";
                    }
                    for (var i = 1; i < <?php echo $count; ?>; i++) {
                        setTimeout(function(i) {
                            var row = document.getElementById('Home' + i);
                            if (row) {
                                for (var p = 90; p >= 0; p--) {
                                    setTimeout(function(p) {
                                        if (row) {
                                            row.style.transform = 'rotateX(' + p + 'deg)';
                                            row.style.opacity = "1";
                                        }
                                    }, (90 - p) * 1.5, p);
                                }
                            }
                        }, i * 100, i);
                    }

                }
                </script>
            </div>
        </div>

    </div>
</div>