<?php
include 'session_check.php';
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
  ?>
  <script>
    const liview = document.querySelector('.icon'); 
    const liviewicon = document.querySelector('.sub_tree');
    liview.classList.add('active');
    liviewicon.classList.add('active');
  </script>
<div class="Attendance_M">
    <div class="head">
        <a href="?page=monthlycreate"><button style='width:70px;'>Generate</button></a>
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
                  <th>SI</th>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>DATE</th>
                  <th>Worked hr</th>
                  <th>Total working hr</th>
                </thead>
                <tbody >
                  <?php

                    $sql = "SELECT employee_details.*,monthly_attendance.* FROM employee_details INNER JOIN monthly_attendance ON employee_details.Emp_id = monthly_attendance.Emp_id WHERE Emp_status=1 AND Month_id='$m_id' ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS UNSIGNED)";
                    $cale="SELECT * FROM company_calender WHERE Month_id='$m_id'";
                    $query = $con->query($sql);
                    $query2 = $con->query($cale);
                    $calender=$query2->fetch_assoc();
                    if($query->num_rows>0)
                    {
                      $i=1;
                      $no = intval($month);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $i; $i++;?></td>
                          <td><?php echo $row['Emp_id']; ?></td>
                          <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;" src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> </td>
                          <td><?php echo $row['Emp_name']/*.' '.$row['lastname']; */?></td>
                          <td><?php echo $monthar[$no]." ".$Year; ?></td> 
                          <td><?php echo $row['Normal_work_hr']."hrs"; ?></td> 
                          <td><?php echo $calender['Working_day']*8;echo"hrs" ?></td> 
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
