
<div class="update_empin"> 
        <?php include '../common/connection.php';
        $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");?>
        <div class="update_form">
            <?php 
            $data=$_GET['id'];
            $emp_query=$con->query("SELECT Rf_id FROM employee_details WHERE Emp_id='$data'");
            $emp_row=$emp_query->fetch_array();
            $rf=$emp_row["Rf_id"];
            ?>
            <div  style="width: 110%" class="emp_details_view">
                <div class="header_view">
                <?php echo "<a href='?page=View_details&id=$data'>X</a>"; ?>
                    <h1 style="width: 60%">Attendance of the Employee</h1>
                    <div></div>
                </div>
                <div  style="border: none; margin-top:0px" class="per_att">
                    <div style="height:90%; width:98%;" class="per_att_table">
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
                                        $sql="SELECT DISTINCT DATE(Time_date) as thedate FROM emp_logs ORDER BY DATE(Time_date) DESC";
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