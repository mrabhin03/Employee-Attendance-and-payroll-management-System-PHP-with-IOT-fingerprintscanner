<?php
  include '../common/connection.php';
  if(isset($_GET['date'])){
    $date = $_GET['date'];
    $month = substr($date, 4, 2);
    $Year = substr($date, 0, 4);
  }else{
    $Year = date('Y');
    $month = date('m');
  }
  
  ?>
<div class="Payrolls">
    <div class="head">
        <a href="?page=generate_salary_page"><button style='width:70px;'>Generate</button></a>
        <h2>Payrolls Details</h2>
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
    <div class="payrolls_details">
        <div class="payrolls_details_sub">
            <table >
                <thead>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Basic Salary</th>
                  <th>Worked hrs</th>
                  <th>Overtime Worked</th>
                  <th>Total Salary</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php
                    $sql = "SELECT DISTINCT employee_details.Emp_id, employee_details.Emp_Photo, employee_details.Emp_name, salary_paid.*, overtime_details.*, employee_designation.*
                    FROM employee_details
                    INNER JOIN salary_paid ON employee_details.Emp_id = salary_paid.Emp_id
                    INNER JOIN employee_designation ON salary_paid.Desc_id = employee_designation.Desc_id
                    INNER JOIN overtime_details ON employee_details.Emp_id = overtime_details.Emp_id
                    AND salary_paid.Month_id = overtime_details.Month_id
                    AND salary_paid.Emp_id = overtime_details.Emp_id
                    WHERE employee_details.Emp_status = 1 AND salary_paid.Month_id = '$m_id'
                    ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS UNSIGNED);";
                    $query = $con->query($sql);
                    if($query->num_rows > 0)
                    {
                      $i=1;
                      $_SESSION['month_id']=$m_id;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['Emp_id']; ?></td>
                          <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;" src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> </td>
                          <td><?php echo $row['Emp_name']?></td>
                          <td><?php echo $row['Desc_name']; ?></td>
                          <td><?php echo "₹".number_format($row['Salary_basic']); ?></td>
                          <td><?php echo ($row['Salary_basic']!=0)? $row['Working_hour']:0 ?>hr</td>
                          <td><?php echo ($row['Salary_basic']!=0)? $row['Overtime_hrs']:0 ?>hr</td>
                          <td><?php echo "₹".number_format($row['Total_salary']); ?></td>
                          <td><?php echo ($row['Salary_status']==1)? "<p style='color: green;'>PAID</p>":"<p style='color: red; font-weigth:none;'>PENDING</p>"; ?></td>
                          <td>
                          <?php $data=$row['Emp_id']; echo "<a href='?page=payroll_details&id=$data'><button class='view-emp' >View Details</button></a>" ?>                            
                          </td>
                        </tr>
                      <?php
                    }
                    ?><tr>
                      <td colspan="10">
                        <?php echo "<a href='?page=paythebill&id=$m_id'><button class='pay'>Pay the Bill</button></a>" ?>
                      </td>
                    </tr><?php
                  }
                  else
                  {
                    ?>
                    <tr>
                      <td colspan="10">
                        NO DATA
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
        </div>

    </div>
</div>
