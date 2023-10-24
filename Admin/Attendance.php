<?php
  include '../common/connection.php';
  $Year = date('Y');
  $month = date('m');
  $day= date('d');
  ?>
<div class="Attendance">
    <div class="head">
    <a href="?page=dailyadd"><button>REFRESH</button></a>
        <h2>Daily Attendance</h2>
        <form method="post">
            <input value="<?php
            if(isset($_POST['search_daily']))
            {
                $daily_date=$_POST['daily_date'];
                echo $daily_date;
            }
            else
            {
                $daily_date=$Year."-".$month."-".$day;
                echo $daily_date;
            }
        ?>" type="date" name="daily_date" required>
            <button name="search_daily" type="submit">Search</button>
        </form>
    </div>
    <div class="Daily_att">
            <div class="Daily_att_sub">
                <table >
                <thead>
                  <th>SI</th>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>DATE</th>
                  <th>STATUS</th>
                  <th>WORKING HOURS</th>
                </thead>
                <tbody >
                  <?php

                    $sql = "SELECT employee_details.*,daily_attendance.* FROM employee_details INNER JOIN daily_attendance ON employee_details.Emp_id = daily_attendance.Emp_id WHERE Emp_status=1 AND Att_date='$daily_date'";
                  
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
                          <td><?php echo $row['Emp_name']/*.' '.$row['lastname']; */?></td>
                          <td><?php echo $row['Att_date']; ?></td>
                          <td><?php echo ($row['Att_status']==1)? "<p style='color: green;'>PRESENT</p>":"<p style='color: red; font-weigth:none;'>ABSENT</p>"; ?></td>
                          <td><?php echo $row['Working_hour']."hrs"; ?></td>
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
