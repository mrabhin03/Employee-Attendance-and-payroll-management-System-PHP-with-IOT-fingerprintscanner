<?php
include 'session_check.php';
  include '../common/connection.php';
  $Year = date('Y');
  $month = date('m');
  $day= date('d');
  if(isset($_GET['date']))
  {
    $value=$_GET['date'];
  }
  else
  {
    $value=$Year."-".$month."-".$day;
  }
  $thmonth = str_replace("-", "", $value);
  $themonth_id = substr($thmonth, 0, 6);
  ?>
    <script>
      const liview = document.querySelector('.icon'); 
      const liviewicon = document.querySelector('.sub_tree');
      liview.classList.add('active');
      liviewicon.classList.add('active');
  </script>
<div class="Attendance">
    <div class="head">
    <form method="post">
            <input onchange="this.form.submit()" value="<?php
            if(isset($_POST['daily_date']))
            {
                $daily_date=$_POST['daily_date'];
                $tday=$daily_date;
                echo $daily_date;
            }
            else
            {
                $daily_date=$value;
                $tday=$daily_date;
                echo $daily_date;
            }

        ?>" type="date" name="daily_date" required>
        </form>
        <h2>Daily Attendance</h2>
        <?php  echo "<a href='?page=dailyadd&date=$tday'><button style='width:70px;'>Generate</button></a>"; ?>
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
                    $thmonth = str_replace("-", "", $daily_date);
                    $themonth_id = substr($thmonth, 0, 6);
                    $day=substr($thmonth, 6, 2);
                    $day = intval($day);
                    $sql = "SELECT employee_details.*, daily_attendance.*
                    FROM employee_details
                    INNER JOIN daily_attendance ON employee_details.Emp_id = daily_attendance.Emp_id
                    WHERE Emp_status = 1 AND Att_date = '$daily_date'
                    ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS UNSIGNED);";
                  
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
                      $holidayquery="SELECT * FROM holidays WHERE Month_id='$themonth_id' AND day='$day'";
                      $holi=$con->query($holidayquery)->num_rows;
                      if($holi> 0)
                      {
                        echo "<tr><td colspan='8' style='background-color: red; color:white;font-size:30px;'>HOLIDAY</td></tr>";
                      }
                      else
                      {
                        echo "<tr><td colspan='8'>No Data</td></tr>";
                      }
                  }
                  ?>
                </tbody>
                </table>
            </div>
        </div>
</div>
