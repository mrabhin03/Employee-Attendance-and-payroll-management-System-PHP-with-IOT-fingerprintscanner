
<div class="update_empin"> 
        <?php include '../common/connection.php';
        $year_month=date('Y-m');
        $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
        $monthdays = array(0,31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        ?>
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
                <div  style="border: none; margin-top:0px;" class="per_att">
                    <div style="height:90%; width:98%; display:flex; flex-direction: column; align-items: center;" class="per_att_table">
                    <form style="width:100%; height: 20px; " method="POST">
                    <input type="month" onchange="this.form.submit()" style="margin-right:40px;float:right; height: 30px;color: #333; width: 130px; border-radius:10px; text-align: center;" 
                    value="<?php
                        if(isset($_POST["year_select"])){
                            $year_month=$_POST["year_select"];
                        }
                        echo $year_month;
                        ?>"
                    name="year_select">
                    <?php          
                        $month_id = str_replace("-", "", $year_month);
                        list($Year, $monthdata) = explode('-', $year_month);
                        if (($Year % 4 == 0 && $Year % 100 != 0) || $Year % 400 == 0) {
                            $monthdays[2]=29;
                        }?>
                    </form>
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
                                        $sql="SELECT DISTINCT DATE(Time_date) as thedate FROM emp_logs WHERE Time_date LIKE '$year_month%' ORDER BY DATE(Time_date) DESC";
                                        $query = $con->query($sql);
                                    if($query->num_rows)
                                    {
                                        $i=1;
                                        for($day=$monthdays[intval($monthdata)];$day>0;$day--)
                                        {
                                            
                                            $date=$Year."-".$monthdata."-".sprintf("%02d", $day);
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
                                            $dayvalue = date("j", strtotime($date));
                                            $holidayor="SELECT * FROM holidays WHERE Month_id='$month_id' AND day='$dayvalue'";
                                            $true=$con->query($holidayor)->num_rows;
                                ?>
                                <tr >
                                    <?php if($true==0)
                                    { ?>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $timein ?></td>
                                    <td><?php echo $timeout ?></td>
                                    <td><?php echo $hours."hrs"; ?></td>
                                    <td><?php echo ($status==1)? "<p style='color: rgb(13, 255, 0);'>PRESENT</p>":"<p style='color: red; font-weigth:none;'>ABSENT</p>"; ?></td>
                                    <?php }
                                    else
                                    {
                                     echo "<td>$date</td>
                                     <td>$timein</td>
                                     <td>$timeout</td>
                                     <td style='font-size:20px; color:red;' colspan='4'>Holiday</td>";   
                                    }?>
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