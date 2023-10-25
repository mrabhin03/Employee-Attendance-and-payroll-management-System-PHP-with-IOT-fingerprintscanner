<?php
include '../../common/connection.php';
$decsearch = $_POST['input'];
                    $sql = "SELECT * FROM employee_designation WHERE Desc_status=1 AND (Desc_name LIKE '$decsearch%' OR Desc_id LIKE '$decsearch%' OR Desc_basic LIKE '$decsearch%')";
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