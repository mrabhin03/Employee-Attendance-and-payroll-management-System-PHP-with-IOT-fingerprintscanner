<?php
  include '../common/connection.php';
  $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  $id=$_SESSION['Emp_id'];
  $year=date('Y');
  ?>
  <script>
    const liview = document.querySelector('.icon'); 
    const liviewicon = document.querySelector('.sub_tree');
    liview.classList.add('active');
    liviewicon.classList.add('active');
  </script>
<div class="perAttendance_M">
    <div class="head">
        <div></div>
        <h2>Monthly Attendance</h2>
        <form method="post">
        <select onchange="this.form.submit()" name="date" id="">
              <?php
              if(isset($_POST["date"]))
              {
                $year=$_POST["date"];
                for($j= 2020;$j<2040;$j++)
                {
                  if($year==$j)
                  {
                    echo "<option selected value='$j'>$j</option>";
                  }
                  else
                  {
                    echo "<option value='$j'>$j</option>";
                  }
                  
                }
              }
              else
              {
                for($j= 2020;$j<2040;$j++)
                {
                  if($year==$j)
                  {
                    echo "<option selected value='$j'>$j</option>";
                  }
                  else
                  {
                    echo "<option value='$j'>$j</option>";
                  }
                  
                }
              }
              ?>
            </select>
        </form>
        
    </div>
    <div class="Monthly_att">
            <div class="Monthly_att_sub">
                <table >
                <thead>
                  <th>SI</th>
                  <th>DATE</th>
                  <th>Worked hr</th>
                  <th>Total working hr</th>
                  <th>Overtime Worked</th>
                  <th>Total working days</th>
                </thead>
                <tbody >
                  <?php

                    $sql = "SELECT employee_details.Emp_id,mothly_attendance.*,overtime_details.*,company_calender.* FROM employee_details INNER JOIN mothly_attendance ON employee_details.Emp_id = mothly_attendance.Emp_id INNER JOIN overtime_details ON employee_details.Emp_id = overtime_details.Emp_id AND
                    mothly_attendance.Month_id = overtime_details.Month_id INNER JOIN company_calender ON mothly_attendance.Month_id = company_calender.Month_id
                    WHERE Emp_status=1 AND mothly_attendance.Month_id LIKE '$year%' AND employee_details.Emp_id='$id'";
                    $query = $con->query($sql);
                    if($query->num_rows>0)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                        $monthdata = substr($row['Month_id'], 4, 2);
                        $monthdata = intval($monthdata);
                      ?>
                        <tr>
                          <td><?php echo $i; $i++;?></td>
                          <td><?php echo $year." ".$monthar[$monthdata]; ?></td> 
                          <td><?php echo $row['Normal_work_hr']."hrs"; ?></td> 
                          <td><?php echo $row['Working_day']*8;echo"hrs" ?></td>
                          <td><?php echo $row['Overtime_hrs']."hrs"; ?></td> 
                          <td><?php echo $row['Working_day']." Days"; ?></td> 
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
