<div class="Bashboard">
    <div class="head">
  <?php
  include '../common/connection.php';
  ?>
    </div>
    <div class="data1">
        <div class="sample_data">
            <div class="box">
                <div class="bodypart">
                <?php
                $sql = "SELECT * FROM employee_details WHERE Emp_status!=2";
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
                $sql = "SELECT * FROM employee_details WHERE Emp_status!=2";
                $query = $con->query($sql);
                $total = $query->num_rows;
                
                $sql = "SELECT * FROM daily_attendance WHERE att_status = 1";
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
                $sql = "SELECT * FROM daily_attendance WHERE att_status = 1";
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
                  <th>ID</th>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>DATE</th>
                  <th>STATUS</th>
                  <th>WORKING HOURS</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php

                    $sql = "SELECT employee_details.*,daily_attendance.* FROM employee_details INNER JOIN daily_attendance ON employee_details.Emp_id = daily_attendance.Emp_id WHERE Emp_status!=2;";
                  
                    $query = $con->query($sql);
                    if($query->num_rows>0)
                    {
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['Att_id'];?></td>
                          <td><?php echo $row['Emp_id']; ?></td>
                          <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;" src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> </td>
                          <td><?php echo $row['Emp_name']/*.' '.$row['lastname']; */?></td>
                          <td><?php echo $row['Att_date']; ?></td>
                          <td><?php echo ($row['Att_status']==1)? "<p style='color: green;'>PRESENT</p>":"<p style='color: red; font-weigth:none;'>ABSENT</p>"; ?></td>
                          <td><?php echo $row['Working_hour']."hrs"; ?></td>
                          <td>
                            <button class="edit-emp" > Edit</button>
                            <button class="delete-emp" >Delete</button>
                          </td>
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