<?php
  include '../common/connection.php';
  $Year = date('Y');
  $month = date('m');
  ?>
<div class="Payrolls">
    <div class="head">
        <a href="?page=generate_salary_page"><button>Generate</button></a>
        <h2>Employees Details</h2>
        <form method="post">
            <input value="<?php
            if(isset($_POST['search_month']))
            {
                $date=$_POST['month_date'];
                list($Year,$month) = explode('-', $date);
            }
            $m_id=$Year.$month;
            echo $Year."-".$month;
        ?>" 
        type="month" name="month_date" required>
            <button name="search_month" type="submit">Search</button>
        </form>
    </div>
    <div class="payrolls_details">
        <div class="payrolls_details_sub">
            <table >
                <thead>
                  <th>SI</th>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Basic Salary</th>
                  <th>Worked hrs</th>
                  <th>Total Salary</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php
                    $sql = "SELECT employee_details.*, salary_paid.*, employee_designation.* FROM employee_details INNER JOIN  salary_paid ON  employee_details.Emp_id = salary_paid.Emp_id INNER JOIN  employee_designation ON  employee_details.Desc_id = employee_designation.Desc_id WHERE  employee_details.Emp_status = 1 AND Month_id='$m_id';";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $i; $i++; ?></td>
                          <td><?php echo $row['Emp_id']; ?></td>
                          <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;" src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> </td>
                          <td><?php echo $row['Emp_name']/*.' '.$row['lastname']; */?></td>
                          <td><?php echo $row['Desc_name']; ?></td>
                          <td><?php echo "₹".$row['Salary_basic']; ?></td>
                          <td><?php echo $row['Working_hour']."hrs"; ?></td>
                          <td><?php echo "₹".$row['Total_salary']; ?></td>
                          <td><?php echo ($row['Salary_status']==1)? "<p style='color: green;'>PAID</p>":"<p style='color: red; font-weigth:none;'>PENDING</p>"; ?></td>
                          <td>
                          <?php $data=$row['Emp_id']; echo "<a href='?page=View_details&id=$data'><button class='view-emp' >View Details</button></a>" ?>                            
                          </td>
                        </tr>
                      <?php
                    }
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
