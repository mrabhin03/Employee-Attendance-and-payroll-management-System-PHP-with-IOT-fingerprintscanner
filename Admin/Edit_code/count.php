<?php
  include '../../common/connection.php';
  $currentdate=date("Y-m-d");
$sql = "SELECT * FROM Employee_details WHERE Emp_status=1";
$query = $con->query($sql);
$total=$query->num_rows;
$sql = "SELECT DISTINCT Rf_id FROM emp_logs WHERE Rf_id IN (SELECT Rf_id FROM employee_details WHERE Emp_status = '1') AND DATE(Time_date)='$currentdate';";
$query = $con->query($sql);
$present = $query->num_rows;
$absent=$total-$present;
$percentage = ($present/$total)*100;
$percentage=number_format($percentage, 2);
echo "$total,$percentage,$present,$absent";

?>