
    <div class="update_empin"> 
        <?php include '../common/connection.php';?>
        <div class="update_form">
            <?php 
            $id=$_GET['id'];
            $query="SELECT * FROM employee_details WHERE Emp_id='$id'";
            $data=$con->query($query);
            $EMP = $data->fetch_assoc(); ?>
         
            <div class="emp_details_view">
                <div class="header_view">
                <a href="?page=Employees">X</a>
                    <h1> Details of the Employee</h1>
                    <div></div>
                </div>
                <div>
                    <div class="profile">
                        <img style=" object-fit: cover; " src="<?php echo (!empty($EMP['Emp_Photo']))? '../images/'.$EMP['Emp_Photo']:'../images/profile.jpg'; ?>" > 
                        <h2><?php echo $EMP['Emp_name'];?></h2>
                        <div class="id_show">ID: <?php echo $EMP['Emp_id'];?></div>
                        <div class="Desc_show"><h4>DESIGNATION ID</h4><?php echo $EMP['Desc_id'];?></div>
                        <div class="Desc_show"><h4>RF ID</h4><?php echo $EMP['Rf_id']; $rf=$EMP['Rf_id'];?></div>
                        <div class="Desc_show"><h4>DATE OF JOIN</h4><?php echo $EMP['Emp_DOJ'];?></div>
                        <div class="Desc_show"><h4>STATUS</h4><?php echo ($EMP['Emp_status']==0)? "<span style='color:red;'>INACTIVE</span>":"<span style='color:green;'>ACTIVE</span>";?></div>
                    </div>
            
                    <div class="data_edit">
                
                        <div class="data_1">
                            <h3>PERSONAL DETAILS</h3>
                            <div class="bar_le">
                                <label >Full name</label>
                                <h6><?php echo $EMP['Emp_name'];?></h6>
                            </div>
                            <div class="sub_div">
                                <div class="DOB">
                                    <label >DATE OF BIRTH</label>
                                    <h6><?php echo $EMP['Emp_DOB'];?></h6>
                                </div>
                                <div class="Gender">
                                    <label >GENDER</label>
                                    <h6><?php echo $EMP['gender'];?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="data_2">
                            <h3>CONTACT</h3>
                            <div class="bar_le">
                                <label>ADDRESS</label>
                                <h6><?php echo $EMP['Emp_Address'];?></h6>
                            </div>
                            <div class="bar_le">
                                <label>Moblie No</label>
                                <h6><?php echo $EMP['Emp_mobileno'];?></h6>
                            </div>
                            <div class="bar_le">
                                <label>Email</label>
                                <h6><?php echo $EMP['Emp_email'];?></h6>
                            </div>
                        </div>
                        <div class="Buttons_bar">
                            <?php $data=$EMP['Emp_id']; echo "<a href='?page=Edit&id=$data'><button style='background-color: lightblue; color:black;'>EDIT</button></a>" ?>
                            <?php $data=$EMP['Emp_id']; echo "<a href='Edit_code/status.php?id=$data&st=2'><button style='background-color: yellow; color:black;'>DELETE</button></a>" ?>
                            <?php $data=$EMP['Emp_id']; 
                            if($EMP['Emp_status']==1)
                            {
                                echo "<a href='Edit_code/status.php?id=$data&st=0'><button style='background-color: red; color:white;'>SUSPEND</button></a>";
                            }
                            else
                            {
                                echo "<a href='Edit_code/status.php?id=$data&st=1'><button style='background-color: green; color:white;'>ACTIVE</button></a>" ;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="per_att">
                    <div style="height:90%; width:98%;" class="per_att_table">
                    <h2 style="width:100%; color: white; ">Attendance of last 6 days</h2>
                        <table >
                            <thead>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Worked hours</th>
                                <th>Status</th>
                            </thead>
                            <tbody id="tabledata">
                                <?php
                                        $sql="SELECT DISTINCT DATE(Time_date) as thedate FROM emp_logs LIMIT 6;";
                                        $query = $con->query($sql);
                                    if($query->num_rows)
                                    {
                                        $i=1;
                                        while($row = $query->fetch_assoc())
                                        {
                                            $date=$row['thedate'];
                                            $invalue_sql="SELECT * FROM emp_logs WHERE Rf_id='$rf' AND DATE(Time_date)='$date'  AND Log_status='IN'";
                                            $inquery = $con->query($invalue_sql);
                                            if($inquery->num_rows)
                                            {
                                                $in=$inquery->fetch_assoc();
                                                $outvalue_sql="SELECT * FROM emp_logs WHERE Rf_id='$rf' AND DATE(Time_date)='$date'  AND Log_status='OUT'";
                                                $outquery = $con->query($outvalue_sql);
                                                $out=$outquery->fetch_assoc();
                                                $timein = date("H:i", strtotime($in['Time_date']));
                                                $timeout = date("H:i", strtotime($out['Time_date']));
                                                $timeincal =strtotime($in['Time_date']);
                                                $timeoutcal = strtotime($out['Time_date']);
                                                $diffInSeconds = $timeoutcal - $timeincal;
                                                $hours = floor($diffInSeconds / 3600); 
                                                $status=1;
                                            }
                                            else
                                            {
                                                $timein = "---";
                                                $timeout = "---";
                                                $status=0;
                                                $hours=0;
                                            }
                                ?>
                                <tr >
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $timein ?></td>
                                    <td><?php echo $timeout ?></td>
                                    <td><?php echo $hours."hrs"; ?></td>
                                    <td><?php echo ($status==1)? "<p style='color: rgb(13, 255, 0);'>PRESENT</p>":"<p style='color: red; font-weigth:none;'>ABSENT</p>"; ?></td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>           
        </div>
    </div>