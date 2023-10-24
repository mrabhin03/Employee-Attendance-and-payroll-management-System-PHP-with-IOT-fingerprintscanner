<?php
  include '../common/connection.php';
  ?>
<div class="Designation">
    <div class="head">
        <a href="?page=adddesc"><button>ADD</button></a>
        <h2>Designation Details</h2>
    </div>
    <div class="des_data">
        <div class="des_detail">
            <table >
                <thead>
                  <th>SI</th>
                  <th>Designation ID</th>
                  <th>Designation Name</th>
                  <th>Basic salary</th>
                  <th>Overtime Salary</th>
                  <th>Dearness allowance</th>
                  <th>Medical allowance</th>
                  <th>Provident fund</th>
                  <th>Increment</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php
                    $sql = "SELECT * FROM employee_designation WHERE Desc_status=1";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $i; $i++; ?></td>
                          <td><?php echo $row['Desc_id']; ?></td>
                          <td><?php echo $row['Desc_name']?></td>
                          <td><?php echo "₹".$row['Desc_basic']; ?></td>
                          <td><?php echo "₹".$row['Desc_overtimesalary']; ?></td>
                          <td><?php echo $row['Desc_da']; ?></td>
                          <td><?php echo $row['Desc_ma']; ?></td>
                          <td><?php echo $row['Desc_pf']; ?></td>
                          <td><?php echo $row['Desc_inc']; ?></td>
                          <td>
                          <?php $data=$row['Desc_id']; echo "<a href='?page=update_desc&id=$data'><button class='view-desc' >Edit Details</button></a>" ?>
                          <?php echo "<a href='?page=delete_desc&id=$data'><button class='view-desc' >Delete</button></a>" ?>                            
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
