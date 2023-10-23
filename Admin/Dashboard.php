<div class="Bashboard">
    <div class="head">
  <?php
  include '../common/connection.php';
  $currentdate=date("Y-m-d");
  ?>
        <a href="?page=dailyadd"><button>REFRESH</button></a>
    </div>
    <div class="data1">
        <div class="sample_data">
            <div class="box">
                <div class="bodypart">
                <?php
                $sql = "SELECT * FROM Employee_details WHERE Emp_status=1";
                $query = $con->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Total Employees</p>
                </div>
                <div class="footerpart">
                <a href="">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                <?php
                $total = $query->num_rows;
                
                $sql = "SELECT * FROM daily_attendance WHERE att_status = 1 AND Att_date='$currentdate'";
                $query = $con->query($sql);
                $present = $query->num_rows;
                $absent=$total-$present;
                $percentage = ($present/$total)*100;

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
                $query = $con->query($sql);
                echo "<h3>".$query->num_rows."</h3>"
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
            <div class="att_header">
                <h3>Daily Attendance report</h3>
                
            </div>
            <div class="att_sub_div1">
                <table >
                <thead>
                  <th>SI</th>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Log in Time</th>
                  <th>Log out Time</th>
                  <th>Status</th>
                </thead>
                <tbody >
                  <?php

                    $sql = "SELECT * FROM employee_details WHERE Emp_status=1;";
                  
                    $query = $con->query($sql);
                    if($query->num_rows>0)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $i; $i++;?></td>
                          <td><?php echo $row['Emp_id']; ?></td>
                          <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;" src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> </td>
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
                          <td><?php echo ($att==1)? "<p style='color: green;'>PRESENT</p>":"<p style='color: red; font-weigth:none;'>ABSENT</p>"; ?></td>
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