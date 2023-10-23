<?php
    if(isset($_POST["gen_payroll"]))
    {
        $year=$_POST['year'];
        $month=$_POST['month']+1;
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);
        $monthid=$year.$month;
        $empdata="SELECT *, employee_details.Emp_id AS empid FROM employee_details LEFT JOIN employee_designation ON employee_designation.desc_id=employee_details.desc_id WHERE Emp_status!=2 ";
        $empdbdata=$con->query($empdata);
        $calender_sql="SELECT * FROM company_calender WHERE Month_id='$monthid'";
        $cal_query=$con->query($calender_sql);
        $cal_day=$cal_query->fetch_assoc();
        $cal_value=$cal_day["Working_day"];
        while($emp=$empdbdata->fetch_array())
        {
            $empid=$emp["Emp_id"];
            $descid=$emp["Desc_id"];
            $salarybasic=$emp["Desc_basic"];
            $salaryda=$emp["Desc_da"];
            $salaryma=$emp["Desc_ma"];
            $salarypf=$emp["Desc_pf"];
            $monthly_att_sql="SELECT * FROM mothly_attendance WHERE Emp_id='$empid' AND Month_id='$monthid'";
            $monthly_att_result=$con->query($monthly_att_sql);
            $monthly_data=$monthly_att_result->fetch_array();
            $workhr=$monthly_data["Normal_work_hr"];
            if($workhr<=(($cal_value-2)*8))
            {
                $hour_salary=$salarybasic/($cal_value*8);
                $month_basic=$workhr*$hour_salary;
                $month_basic = (int)$month_basic;
            }
            else
            {
                $month_basic=$salarybasic;
            }
            $month_total=($month_basic+$salaryda+$salaryma)-$salarypf;
            $check_salary_sql="SELECT * FROM salary_paid WHERE Emp_id='$empid' AND Month_id='$monthid'";
            $check_salary_query=$con->query($check_salary_sql);
            if($check_salary_query->num_rows > 0)
            {
                $salary_insert="UPDATE salary_paid SET Salary_basic = '$month_basic', Salary_da = '$salaryda', Salary_ma = '$salaryma', Salary_pf = '$salarypf', Working_hour = '$workhr', Total_salary = '$month_total' WHERE Emp_id = '$empid' AND Month_id = '$monthid';";
            }
            else
            {
                $salary_insert="INSERT INTO salary_paid (Emp_id, Desc_id, Month_id, Salary_basic, Salary_da, Salary_ma, Salary_pf, Salary_status, Working_hour, Total_salary) VALUES ('$empid','$descid','$monthid','$month_basic','$salaryda','$salaryma','$salarypf',0,'$workhr','$month_total')";
            }
            $con->query($salary_insert);
        }
        echo "<script>window.location.href = '?page=Payrolls';</script>";
    }
?>