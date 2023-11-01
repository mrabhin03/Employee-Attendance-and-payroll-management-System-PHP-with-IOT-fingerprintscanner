<?php
include 'session_check.php';
include '../common/connection.php';
$no=101;

?><div class="main_noti">
    <div class="noti_sub">
        <div class="noti_body">
            <div class="head">
                <h2 align='center'>Update Requests</h2>
            </div>
            <table>
                <thead style="font-size:24px">
                    <th>SI</th>
                    <th>Employee ID</th>
                    <th>Changes</th>
                    <th>Tools</th>
                </thead>
                <tbody id="tabledata">
                    <?php
                  
                    $sql = "SELECT * FROM employee_details WHERE Emp_status='$no'";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                        $position = strpos($row['Emp_id'], 'E');
                        if ($position !== false) {
                            $result = substr($row['Emp_id'], $position);
                        }
                      ?>
                    <tr style="  border: 9px solid rgb(0, 0, 0);">
                        <td style="font-size:200%;"><?php echo $i; $i++; ?></td>
                        <td style="font-size:200%;"><?php echo $result; ?></td>
                        <td>
                            <table style="text-align:left; width: 100%; border-collapse: collapse;">
                                <?php
                                $sqlt2 = "SELECT * FROM employee_details WHERE Emp_id='$result'";
                                $queryt2 = $con->query($sqlt2);
                                if($queryt2->num_rows)
                                {
                                    $row2=$queryt2->fetch_assoc();
                                    
                                        if($row2['Emp_name']!=$row['Emp_name'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>NAME</td>";
                                            if($row2['Emp_name']=='')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_name']."</td>";
                                            }
                                            echo "<td>-></td>";
                                            echo "<td>".$row["Emp_name"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_Address']!=$row['Emp_Address'])
                                        {
                                            
                                            echo "<tr class='newtable'>";
                                            echo "<td>Address</td>";
                                            if($row2['Emp_Address']=='0')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_Address']."</td>";
                                            }
                                            echo "<td>-></td>";
                                            echo "<td>".$row["Emp_Address"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_DOB']!=$row['Emp_DOB'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Date of birth</td>";
                                            if($row2['Emp_DOB']=='0000-00-00')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_DOB']."</td>";
                                            }
                                            echo "<td>-></td>";
                                            echo "<td>".$row["Emp_DOB"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_mobileno']!=$row['Emp_mobileno'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Moble no</td>";
                                            if($row2['Emp_mobileno']=='0')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_mobileno']."</td>";
                                            }
                                            echo "<td>-></td>";
                                            echo "<td>".$row["Emp_mobileno"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['gender']!=$row['gender'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Gender</td>";
                                            if($row2['gender']=='')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['gender']."</td>";
                                            }
                                            echo "<td>-></td>";
                                            echo "<td>".$row["gender"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_Photo']!=$row['Emp_Photo'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Photo</td>";
                                            if($row2['Emp_Photo']=='')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_Photo']."</td>";
                                            }
                                            echo "<td>-></td>";
                                            if($row['Emp_Photo']=='')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row['Emp_Photo']."</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        
                                }
                            ?>
                            </table>
                        </td>
                        <td>
                            <?php $data=$row['Emp_id']; echo "<a href='?page=Approvechange&id=$data&va=1'><button class='view-emp' >Approve</button></a>" ?>
                            <?php $data=$row['Emp_id']; echo "<a href='?page=Approvechange&id=$data&va=0'><button class='view-emp' >Reject</button></a>" ?>
                        </td>
                    </tr>
                    <?php
                    }
                  }
                  else
                  {
                    ?>
                    <tr>
                        <td colspan="4">
                            NO Requests
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
</div>