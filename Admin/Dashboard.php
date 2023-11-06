<?php include 'session_check.php';?>
<div class="thefulldiv">
    <div class="loading">
        <div align='center' class="sureq">
            <h4>Are you sure? </h4><br>
            <h4>You want to delete all data</h4>
            <div class="footer">
                <button onclick='areyousure()'>Cancel</button>
                <?php echo "<a onclick='loadthebar()' href='?page=dailyadd'><button>Yes</button></a>"; ?>
            </div>
        </div>
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <h2>Please wait till <br>all data are fetched <br>(This will take a while)</h2>
    </div>
</div>
<div class="Bashboard">
    <div style="display: flex; justify-content: space-between;" class="head">
        <?php echo "<a onclick='areyousure()'><button style='width:140px; height: 36px; font-size: 17px;'>Refresh all data</button></a>"; ?>
        <h3>Daily Attendance report </h3>
        <div></div>
        <script>
        const loading = document.querySelector('.loading');
        const areq = document.querySelector('.sureq');
        const areyou = document.querySelector('.thefulldiv');

        function loadthebar() {

            if (loading.classList.contains('active')) {
                loading.classList.remove('active');
            } else {
                loading.classList.add('active');
                areq.classList.add('deactive');
            }
        }

        function areyousure() {
            if (areyou.classList.contains('active')) {
                areyou.classList.remove('active');
            } else {
                areyou.classList.add('active');
            }
        }
        </script>
        <?php
  include '../common/connection.php';
  $currentdate=date("Y-m-d");
  ?>

    </div>
    <div class="data1">
        <div class="sample_data">
            <div class="box">
                <div class="bodypart">
                    <h3 id="toemp">0</h3>
                    <p>Total Employees</p>
                </div>
                <div class="footerpart">
                    <a href="?page=Employees">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <div
                        style=" margin-top:10px; width:100%; height:35px;display:flex; flex-direction: row; justify-content:center; align-item:center;">
                        <h3 style="font-size:30px; margin-top:0px;" id="pre">0</h3><sup style='font-size: 20px;'>%</sup>
                    </div>
                    <p>Present Percentage</p>
                </div>
                <div class="footerpart">
                    <a href="?page=Monthly_attendance">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <h3 id="topre">0</h3>
                    <p>Today's Present</p>
                </div>
                <div class="footerpart">
                    <a href="?page=Attendance">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <h3 id="toab">0</h3>
                    <p>Today's Absents</p>
                </div>
                <div class="footerpart">
                    <a href="?page=Attendance">More info</a>
                </div>
            </div>

        </div>
        <script>
        var data1 = 0;
        var data2 = 0;
        var data3 = 0;
        var data4 = 0;

        function count() {
            var xhr = new XMLHttpRequest();
            var url = "Edit_code/count.php";

            xhr.open("POST", url, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Check the response from PHP
                    var response = xhr.responseText.split(',');
                    data1 = parseInt(response[0]);
                    data2 = response[1];
                    data3 = parseInt(response[2]);
                    data4 = parseInt(response[3]);
                    autoin1();
                }
            };
            xhr.send(null); // No need to send any data
        }
        count();
        var h1Element = document.getElementById('toemp');
        var i = 1;

        function autoin1() {
            if (i <= data1) {
                h1Element.innerHTML = i;
                i++;
                setTimeout(autoin1, 20);
            } else {
                autoin2();
            }
        }
        var min = 10;
        var max = 99;

        function autoin2() {
            var j = 0;

            var anotherH1Element = document.getElementById('pre');

            function updateAnotherValue1() {
                if (j <= data2) {
                    var randomNum = Math.floor(Math.random() * (max - min + 1)) + min;
                    anotherH1Element.innerHTML = j +'.'+randomNum;
                    j++;
                    setTimeout(updateAnotherValue1, 10);
                } else {
                    anotherH1Element.innerHTML = data2;
                    autoin3();
                }
            }

            updateAnotherValue1();
        }

        function autoin3() {
            var j = 1;
            var anotherH1Element = document.getElementById('topre');

            function updateAnotherValue2() {
                if (j <= data3) {
                    anotherH1Element.innerHTML = j;
                    j++;
                    setTimeout(updateAnotherValue2, 30);
                } else {
                    autoin4();
                }
            }

            updateAnotherValue2();
        }

        function autoin4() {
            var j = 1;
            var anotherH1Element = document.getElementById('toab');

            function updateAnotherValue3() {
                if (j <= data4) {
                    anotherH1Element.innerHTML = j;
                    j++;
                    setTimeout(updateAnotherValue3, 50);
                }
            }

            updateAnotherValue3();
        }
        </script>
        <div class="employee_att">
            <div class="att_sub_div1">
                <table>
                    <thead>
                        <th>SI</th>
                        <th>Employee ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Log in Time</th>
                        <th>Log out Time</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php

                    $sql = "SELECT * FROM employee_details WHERE Emp_status=1 ORDER BY CAST(SUBSTRING(`Emp_id`, 2) AS SIGNED);";
                  
                    $query = $con->query($sql);
                    if($query->num_rows>0)
                    {
                      $i=1;
                      $p=0;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $row['Emp_id']; ?></td>
                            <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                    src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>"
                                    width="30px" height="30px"> </td>
                            <td><?php echo $row['Emp_name']; ?></td>
                            <?php
                            $rf=$row['Rf_id'];
                            $select1="SELECT Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id=$rf AND Log_status='IN'";
                            $IN = $con->query($select1);
                            if($IN->num_rows> 0)
                            {
                              $att=1;
                              $INrow = $IN->fetch_assoc();
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
                            else
                            {
                              $att=0;
                              $INdata="---";
                              $OUTdata="---";
                            }
                          ?>
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
                  }
                  else
                  {
                    ?>
                        <tr>
                            <td colspan="8">NO Data</td>
                        </tr>
                        <?php
                  }
                  ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>