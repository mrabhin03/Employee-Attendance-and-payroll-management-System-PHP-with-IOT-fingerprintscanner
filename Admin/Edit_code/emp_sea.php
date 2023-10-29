<?php include 'session_check.php';
include '../../common/connection.php';
$search = $_POST['input'];
                    $sql = "SELECT *, employee_details.Emp_id AS empid FROM employee_details LEFT JOIN employee_designation ON employee_designation.desc_id=employee_details.desc_id WHERE Emp_status!=2 AND (Emp_name LIKE '$search%' OR Emp_id LIKE '$search%' OR Desc_name LIKE '$search%') ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS SIGNED)  ;";
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
                          <td><?php echo "₹".$row['Desc_basic']; ?></td>
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
                      <td colspan="9">
                        NO DATA
                      </td>
                    </tr>
                    <?php
                  }
                  ?>