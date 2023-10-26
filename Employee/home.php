<div class="EMP_HOME">
    <div style="display: flex; justify-content: space-between;" class="head">
    <h3>Daily Attendance report </h3>
    <div></div>
  <?php
  include '../common/connection.php';
  $currentmonth=date("Y-m");
  $monthid=date("Ym");
  $monthvalue=date("n");
  $id=$_SESSION['Emp_id'];
  $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  $monthdays = array(0,31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  ?>
        
    </div>
    <div class="data1">
        <div class="sample_data">
            <div class="box">
                <div class="bodypart">
                <?php
                $sql = "SELECT Working_day FROM company_calender WHERE Month_id='$monthid'";
                $query = $con->query($sql);
                $calender_data=$query->fetch_assoc();
                echo "<h3>".$calender_data['Working_day']."</h3>";
              ?>

              <p>Total Working days</p>
                </div>
                <div class="footerpart">
                <a href="">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                <?php
                $EMPsql = "SELECT * FROM employee_details WHERE Emp_status=1 AND Emp_id='$id';";
                $empquery = $con->query($EMPsql);
                $row = $empquery->fetch_assoc();
                $rf=$row["Rf_id"];
                $att_sql="SELECT * FROM emp_logs WHERE Rf_id='$rf' AND DATE(Time_date) LIKE '$currentmonth%' AND Log_status='IN'";
                $att_data = $con->query($att_sql);
                $present=$att_data->num_rows;
                $percentage = ($present/$calender_data['Working_day'])*100;
                $absent=$calender_data['Working_day']-$present;
                echo "<h3>".number_format($percentage, 2)."<sup style='font-size: 20px'>%</sup></h3>";
              ?>
          
              <p>Present Percentage</p>
                </div>
                <div class="footerpart">
                    <a href="">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                <?php
                echo "<h3>".$present."</h3>"
              ?>
              <p>Today's Present</p>
                </div>
                <div class="footerpart">
                <a href="">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                <?php
                echo "<h3>".$absent."</h3>"
              ?>
              <p>Today's Absents</p>
                </div>
                <div class="footerpart">
                <a href="">More info</a>
                </div>
            </div>

        </div>
        <div class="employee_att">
            <div class="att_sub_div1">
                <table >
                <thead>
                  <th>SI</th>
                  <th>Date</th>
                  <th>Log in Time</th>
                  <th>Log out Time</th>
                  <th>Status</th>
                </thead>
                <tbody >
                  <?php
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
                      
                            $select1="SELECT Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id=$rf AND Log_status='IN'";
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
                          ?>
                        <tr>
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