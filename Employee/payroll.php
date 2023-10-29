<div class="per_Payrolls">
    <?php  include '../common/connection.php';
    $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
    $id=$_SESSION['Emp_id'];
    $year=date('Y');
    ?>
    <div class="head">
        <div></div>
        <h2>Payrolls Details</h2>
        <form method="post">
        <select onchange="this.form.submit()" name="date" id="">
              <?php
              if(isset($_POST["date"]))
              {
                $year=$_POST["date"];
              }
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
              ?>
            </select>
        </form>
    </div>
    <div class="payrolls_details">
        <div class="payrolls_details_sub">
            <table >
                <thead>
                  <th>Month</th>
                  <th>Designation</th>
                  <th>Designation Salary</th>
                  <th>Worked hrs</th>
                  <th>Basic Salary</th>
                  <th>Overtime Worked</th>
                  <th>Total Salary</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php
                    $sql = "SELECT employee_designation.*, salary_paid.*, overtime_details.*
                    FROM salary_paid
                    INNER JOIN employee_designation ON employee_designation.Desc_id = salary_paid.Desc_id
                    INNER JOIN overtime_details ON salary_paid.Emp_id = overtime_details.Emp_id AND salary_paid.Month_id = overtime_details.Month_id
                    WHERE salary_paid.Emp_id = '$id' AND salary_paid.Month_id LIKE '$year%';";
                    $query = $con->query($sql);
                    if($query->num_rows > 0)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                        $monthdata = substr($row['Month_id'], 4, 2);
                        $monthdata = intval($monthdata);
                        if($row['Desc_basic']>0)
                        {
                            echo "<tr style='font-size:17px;'>";
                        }
                        else
                        {
                            echo "<tr style='background-color: red; font-size:17px; color:white;border: 2px solid white;'>";
                        }
                      ?>
                        
                            <td><?php echo $year." ".$monthar[$monthdata];  ?></td>
                            <td><?php echo $row['Desc_name']; ?></td>
                            <td><?php echo "₹".number_format($row['Desc_basic']);?></td>
                            <td><?php echo ($row['Salary_basic']!=0)? $row['Working_hour']:0 ?>hr</td>
                            <td><?php echo "₹".number_format($row['Salary_basic']); ?></td>
                            <td><?php echo ($row['Salary_basic']!=0)? $row['Overtime_hrs']:0 ?>hr</td>
                            <td><?php echo "₹".number_format($row['Total_salary']); ?></td>
                            <td><?php echo ($row['Salary_status']==1)? "<p style='color: green;'>PAID</p>":"<p style='color: red; font-weigth:none;'>PENDING</p>"; ?></td>
                            <td>
                          <?php $month=$row['Month_id'];  echo "<a href='?page=per_payroll&check=$month'><button class='view-emp' >View Details</button></a>" ?>                            
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