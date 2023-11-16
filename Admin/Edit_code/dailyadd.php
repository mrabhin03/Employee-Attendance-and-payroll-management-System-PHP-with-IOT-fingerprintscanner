<?php
include 'session_check.php';
include '../common/connection.php';
$monthco = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
set_time_limit(5000);
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $_SESSION['datevalue']=$date;
    $currentdate=$date;
    $log_sql="SELECT DATE(Time_date) as thedate FROM emp_logs WHERE DATE(Time_date)='$date';";
    if($con->query($log_sql)->num_rows == 0){
        $inserttemp="INSERT INTO emp_logs( Rf_id, Log_status, Time_date) VALUES ('999','52','$date')";
        $con->query($inserttemp);
        $log_sql="SELECT DATE(Time_date) as thedate FROM emp_logs WHERE DATE(Time_date)='$date';";
        $log_query=$con->query($log_sql);
        $deletetemp="DELETE FROM emp_logs WHERE Rf_id='999'";
        $con->query($deletetemp);
    } 
    else
    {
        $log_query=$con->query($log_sql);
    }
}else{
    $log_sqlmax="SELECT MAX(DATE(Time_date)) as maxthedate FROM emp_logs;";
    $maxlog_query=$con->query($log_sqlmax);
    $maxdatevalu=$maxlog_query->fetch_assoc();
    $log_sqlmin="SELECT MIN(DATE(Time_date)) as minthedate FROM emp_logs;";
    $minlog_query=$con->query($log_sqlmin);
    $mindatevalu=$minlog_query->fetch_assoc();
    $newdatequery="WITH RECURSIVE DateRange AS (
        SELECT CAST('".$mindatevalu['minthedate']."' AS DATE) AS thedate
        UNION ALL
        SELECT thedate + INTERVAL 1 DAY
        FROM DateRange
        WHERE thedate < '".$maxdatevalu['maxthedate']."'
    )
    
    SELECT thedate
    FROM DateRange;";
    $log_query=$con->query($newdatequery);
    $reset_queries = [
        "DELETE FROM salary_paid WHERE 1",
        "DELETE FROM daily_attendance WHERE 1",
        "DELETE FROM monthly_attendance WHERE 1",
        "DELETE FROM overtime_details WHERE 1",
        "DELETE FROM salary_paid WHERE 1",
    ];
    
    foreach ($reset_queries as $query) {
        $con->query($query);
    }
    
}

while($logdate=$log_query->fetch_assoc())
{
    $currentdate=$logdate['thedate'];
    $monthid = date('Ym', strtotime($currentdate));
    $Yearnew = date('Y', strtotime($currentdate));
    $monthnew = date('m', strtotime($currentdate));
    $dayva = intval(date('d', strtotime($currentdate)));
    $holidaysql="SELECT * FROM holidays WHERE Month_id='$monthid' AND day='$dayva'";
    $yesorno = $con->query($holidaysql)->num_rows;
    if($yesorno> 0)
    {
        
    }
    else {
        $cale="SELECT * FROM company_calender WHERE Month_id='$monthid'";
                    $query2 = $con->query($cale);
                    if($query2->num_rows==0)
                    {
                      if (($Yearnew % 4 == 0 && $Yearnew % 100 != 0) || ($Yearnew % 400 == 0)) {
                        $monthco[2]=29;
                      }
                      else {
                        $monthco[2]=28;
                      }
                      $daysval=$monthco[intval($monthnew)];
                      $sqlin="INSERT INTO company_calender(Month_id,Year, Month, Working_day) VALUES ('$monthid','$Yearnew','$monthnew','$daysval')";
                      $con->query($sqlin);
                    }


    $emp="SELECT * FROM employee_details WHERE Emp_status=1 AND DATE_FORMAT(Emp_DOJ, '%Y%m')<='$monthid' ORDER BY CAST(SUBSTRING('Emp_id', 2) AS SIGNED) ";
    $emp_details=$con->query($emp);
    while($data=$emp_details->fetch_assoc())
    {
        
        $emp_rf=$data['Rf_id'];
        $emp_id=$data['Emp_id'];
        $IN="SELECT Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id='$emp_rf' AND Log_status='IN'";
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
                if(mysqli_num_rows($INquery)> 1)
                {
                    $doublein1sql="SELECT MIN(Time_date) as inmin FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id='$emp_rf' AND Log_status='IN'";
                    $doubleout1sql="SELECT MIN(Time_date) as outmin FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id='$emp_rf' AND Log_status='OUT'";
                    $firstin=$con->query($doublein1sql)->fetch_assoc();
                    $firstinvalue = new DateTime($firstin['inmin']);
                    $firstout=$con->query($doubleout1sql)->fetch_assoc();
                    $firstoutvalue = new DateTime($firstout['outmin']);
                    $interval1 = $firstinvalue->diff($firstoutvalue);
                    $hours1 = $interval1->format('%h');
                    $doublein2sql="SELECT MAX(Time_date) as inmax FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id='$emp_rf' AND Log_status='IN'";
                    $doubleout2sql="SELECT MAX(Time_date) as outmax FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id='$emp_rf' AND Log_status='OUT'";
                    $secoin=$con->query($doublein2sql)->fetch_assoc();
                    $secinvalue = new DateTime($secoin['inmax']);
                    $secoinout=$con->query($doubleout2sql)->fetch_assoc();
                    $secoutvalue = new DateTime($secoinout['outmax']);
                    $interval2 = $secinvalue->diff($secoutvalue);
                    $hours2 = $interval2->format('%h');
                    $hours=$hours1+$hours2;
                }
                else
                {
                    $OUTrow=$OUTquery->fetch_assoc();
                    $datetime2 = new DateTime($OUTrow['Time_date']);
                    $interval = $datetime1->diff($datetime2);
                    $hours = $interval->format('%h');
                }
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
    
}

if(isset($_GET['date'])){
    echo "<script>window.location.href = '?page=Attendance';</script>";
}else{
    include 'al_month.php';
}
?>