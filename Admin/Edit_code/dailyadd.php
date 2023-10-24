<?php
include '../common/connection.php';
$log_sql="SELECT DISTINCT DATE(Time_date) as thedate FROM emp_logs;";
$log_query=$con->query($log_sql);
while($logdate=$log_query->fetch_assoc())
{
    $currentdate=$logdate['thedate'];
    $emp="SELECT * FROM employee_details WHERE Emp_status=1 ORDER BY CAST(SUBSTRING('Emp_id', 2) AS SIGNED)";
    $emp_details=$con->query($emp);
    while($data=$emp_details->fetch_assoc())
    {
        $emp_rf=$data['Rf_id'];
        $emp_id=$data['Emp_id'];
        $IN="SELECT Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id=$emp_rf AND Log_status='IN'";
        $INquery=$con->query($IN);
        $check="SELECT * FROM daily_attendance WHERE Att_date='$currentdate' AND Emp_id='$emp_id'";
        $checkquery=$con->query($check);
        if(mysqli_num_rows($INquery)>0)
        {
            $INrow=$INquery->fetch_assoc();
            $OUT="SELECT Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id=$emp_rf AND Log_status='OUT'";
            $OUTquery=$con->query($OUT);
            $datetime1 = new DateTime($INrow['Time_date']);
            if(mysqli_num_rows($OUTquery)>0)
            {
                $OUTrow=$OUTquery->fetch_assoc();
                
                $datetime2 = new DateTime($OUTrow['Time_date']);
                // Calculate the difference
                $interval = $datetime1->diff($datetime2);
                // Extract the difference in hours
                $hours = $interval->format('%h');
    
                if(mysqli_num_rows($checkquery)>0)
                {
                    $insert="UPDATE daily_attendance SET Working_hour='$hours', Att_status='1' WHERE Att_date='$currentdate' AND Emp_id='$emp_id'";
                }
                else
                {
                    $insert="INSERT INTO daily_attendance (Att_date, Emp_id, Att_status, Working_hour) VALUES ('$currentdate','$emp_id','1','$hours')";
                }
                
            }
            else
            {
                if(mysqli_num_rows($checkquery)>0)
                {
                    $insert="UPDATE daily_attendance SET Working_hour='0', Att_status='1' WHERE Att_date='$currentdate' AND Emp_id='$emp_id'";
                }
                else
                {
                    $insert="INSERT INTO daily_attendance (Att_date, Emp_id, Att_status, Working_hour) VALUES ('$currentdate','$emp_id','1','0')";
                }
                
            }
            
        }
        else
        {
            if(mysqli_num_rows($checkquery)>0)
                {
                    $insert="UPDATE daily_attendance SET Working_hour='0', Att_status='0' WHERE Att_date='$currentdate' AND Emp_id='$emp_id'";
                }
                else
                {
                    $insert="INSERT INTO daily_attendance (Att_date, Emp_id, Att_status, Working_hour) VALUES ('$currentdate','$emp_id','0','0')"; 
                }
              
        }
        $con->query($insert);
        
    }
}


echo "<script>window.location.href = '?page=Attendance';</script>";
?>