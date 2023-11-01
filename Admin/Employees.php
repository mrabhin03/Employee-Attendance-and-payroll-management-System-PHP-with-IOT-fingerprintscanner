<?php
include 'session_check.php';
  include '../common/connection.php';
  ?>
<div class="Employees">
    <div class="head">
        <a href="?page=addemp"><button>ADD</button></a>
        <h2>Employees Details</h2>
        <form method="post">
            <input id="search" type="text" placeholder="Search" name="sevalue">
        </form>
        <script type="text/javascript">
          $(document).ready(function()
          {
            $('#search').keyup(function()
            {
              
              var input =$(this).val();
                $.ajax({
                  url:"Edit_code/emp_sea.php",
                  method: "POST",
                  data:{input:input},
                  success:function(data)
                  {
                    $("#tabledata").html(data);
                  }
                })
            })
          })
        </script>
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
                  <th>Date of Join</th>
                  <th>Salary</th>
                  <th>Mobile No</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody id="tabledata">
                  <?php
                  
                    $sql = "SELECT employee_details.*, designation_for_employee.*, employee_designation.*
                    FROM employee_details
                    INNER JOIN designation_for_employee ON employee_details.Emp_id = designation_for_employee.Emp_id
                    INNER JOIN employee_designation ON designation_for_employee.Desc_id = employee_designation.Desc_id
                    WHERE employee_details.Emp_status != 2 AND designation_for_employee.Desc_status='1'
                    ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS SIGNED);";
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
                          <td><?php echo $row['Emp_name']?></td>
                          <td><?php echo $row['Desc_name']; ?></td>
                          <td><?php echo $row['Emp_DOJ']; ?></td>
                          <td><?php echo "₹".$row['Desc_basic']; ?></td>
                          <td><?php echo $row['Emp_mobileno']; ?></td>
                          <td><?php 
                          if($row['Emp_status']==0) 
                          {
                            echo "<p style='color: red; font-weigth:none;'>INACTIVE</p>";
                          }
                          elseif($row['Emp_status']==1)
                          {
                            echo "<p style='color: green;'>ACTIVE</p>";
                          }
                          else
                          {
                            echo "<p style='color: blue;'>PENDING</p>";
                          }
                          ?></td>
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
