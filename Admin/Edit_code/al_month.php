<?php
  include '../common/connection.php';
  set_time_limit(300);
        $total_mont_sql="SELECT DISTINCT Att_date as Dates FROM daily_attendance;";
        $total_mont_query=$con-> query($total_mont_sql);
        if($total_mont_query->num_rows > 0)
        {
            while($montdata = $total_mont_query->fetch_assoc())
            {
                $date = date("Y-m", strtotime($montdata['Dates']));
                $monthid = date("Ym", strtotime($montdata['Dates']));
                $empdata="SELECT * FROM employee_details";
        $empdbdata=$con->query($empdata);
        while($emp=$empdbdata->fetch_array())
        {
            $empid=$emp['Emp_id'];
            $datecheck="SELECT * FROM daily_attendance WHERE Att_date LIKE '$date%' AND Emp_id='$empid' AND Att_status=1";
            $data=$con->query($datecheck);
            $dec_id=$emp['Desc_id'];
            $dec="SELECT Desc_overtimesalary FROM employee_designation WHERE Desc_id='$dec_id'";
            $desdata=$con->query($dec);
            $des_os=$desdata->fetch_array();
            $Oversalary=$des_os["Desc_overtimesalary"];

            $monthlydata="SELECT * FROM mothly_attendance WHERE Emp_id='$empid' AND Month_id='$monthid'";
            $monthcheck=$con->query($monthlydata);

            if($data->num_rows > 0)
            {
                $hours1=0;
                $hours2=0;
                $count=0;
                while($row = $data->fetch_assoc())
                {
                    if($row['Working_hour']<=8)
                    {
                        $hours1+=$row['Working_hour'];
                    }
                    else
                    {
                        $hours2+=$row['Working_hour'];
                        $count++;
                    }
                    
                }
                $normalhours=$hours1+(8*$count);
                $overhours=$hours2-(8*$count);
                if($monthcheck->num_rows>0)
                {
                    $insert_mo="UPDATE mothly_attendance SET Normal_work_hr='$normalhours' WHERE Emp_id='$empid' AND  Month_id='$monthid'";
                    $insert_ov="UPDATE overtime_details SET Overtime_hrs='$overhours'  WHERE Emp_id='$empid' AND  Month_id='$monthid'";
                }
                else
                {
                    $insert_mo="INSERT INTO mothly_attendance(Emp_id, Month_id, Normal_work_hr) VALUES ('$empid','$monthid','$normalhours')";
                    $insert_ov="INSERT INTO overtime_details(Emp_id, Month_id, Overtime_hrs, Overtime_salary) VALUES ('$empid','$monthid','$overhours','$Oversalary')";
                }
            }
            else
            {
                if($monthcheck->num_rows>0)
                {
                    $insert_mo="UPDATE mothly_attendance SET Normal_work_hr=0 WHERE Emp_id='$empid' AND  Month_id='$monthid'";
                    $insert_ov="UPDATE overtime_details SET Overtime_hrs=0  WHERE Emp_id='$empid' AND  Month_id='$monthid'";
                }
                else
                {
                    $insert_mo="INSERT INTO mothly_attendance(Emp_id, Month_id, Normal_work_hr) VALUES ('$empid','$monthid','0')";
                    $insert_ov="INSERT INTO overtime_details(Emp_id, Month_id, Overtime_hrs, Overtime_salary) VALUES ('$empid','$monthid','0','$Oversalary')";
                }
            }
            $con->query($insert_mo);
            $con->query($insert_ov);

        }
            }
        }
        echo "<script>window.location.href = '?page=al_payroll';</script>";
        
?>