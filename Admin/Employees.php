<?php
  include '../common/connection.php';
  ?>
<div class="Employees">
    <div class="head">
        <a href="?page=addemp"><button>ADD</button></a>
        <h2>Employees Details</h2>
    </div>
    <div class="data2">
        <div class="employee_detail">
            <table >
                <thead>
                  <th>SI</th>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Salary</th>
                  <th>Mobile No</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php
                    $sql = "SELECT *, employee_details.Emp_id AS empid FROM employee_details LEFT JOIN employee_designation ON employee_designation.desc_id=employee_details.desc_id WHERE Emp_status!=2 order by Emp_name ASC ;";
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
                          <td><?php echo "$".$row['Desc_basic']; ?></td>
                          <td><?php echo $row['Emp_mobileno']; ?></td>
                          <td><?php echo ($row['Emp_status']==1)? "<p style='color: green;'>ACTIVE</p>":"<p style='color: red; font-weigth:none;'>INACTIVE</p>"; ?></td>
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
                      <td colspan="8">
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
