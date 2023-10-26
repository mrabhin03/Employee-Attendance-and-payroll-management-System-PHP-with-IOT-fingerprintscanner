<?php
  include '../common/connection.php';
  $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  if(isset($_GET['date']))
  {
    list($Year,$month) = explode('-', $_GET['date']);
  }
  else{
    $Year = date('Y');
    $month = date('m');
  }
  $id=$_SESSION['Emp_id'];
  ?>
  <script>
    const liview = document.querySelector('.icon'); 
    const liviewicon = document.querySelector('.sub_tree');
    liview.classList.add('active');
    liviewicon.classList.add('active');
  </script>
<div class="perAttendance_M">
    <div class="head">
        <a href="?page=monthlycreate"><button>Generate</button></a>
        <h2>Monthly Attendance</h2>
        <form method="post">
            <input value="<?php
            if(isset($_POST['month_date']))
            {
                $date=$_POST['month_date'];
                list($Year,$month) = explode('-', $date);
            }
            $m_id=$Year.$month;
            echo $Year."-".$month;
        ?>" 
        type="month" onchange="this.form.submit()" name="month_date" required>
        </form>
        
    </div>
    <div class="Monthly_att">
            <div class="Monthly_att_sub">
                <table >
                <thead>
                  <th>Name</th>
                  <th>DATE</th>
                  <th>Worked hr</th>
                  <th>Total working hr</th>
                </thead>
                <tbody >
                  <?php

                    $sql = "SELECT employee_details.Emp_id,mothly_attendance.*,overtime_details.*,company_calender.* FROM employee_details INNER JOIN mothly_attendance ON employee_details.Emp_id = mothly_attendance.Emp_id INNER JOIN overtime_details ON employee_details.Emp_id = overtime_details.Emp_id AND
                    mothly_attendance.Month_id = overtime_details.Month_id INNER JOIN company_calender ON mothly_attendance.Month_id = company_calender.Month_id
                    WHERE Emp_status=1 AND mothly_attendance.Month_id LIKE '2023%' AND employee_details.Emp_id='$id'";
                    $query = $con->query($sql);
                    if($query->num_rows>0)
                    {
                      $i=1;
                      $no = intval($month);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $i; $i++;?></td>
                          <td><?php echo $row['Month_id']; ?></td> 
                          <td><?php echo $row['Normal_work_hr']."hrs"; ?></td> 
                          <td><?php echo $row['Working_day']*8;echo"hrs" ?></td> 
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
