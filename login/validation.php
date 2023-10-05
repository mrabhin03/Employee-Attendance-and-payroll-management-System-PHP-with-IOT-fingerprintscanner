<?php
// login.php (inside the login folder)
include '../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Check if the username starts with "A"
        if (strpos($username, "A") === 0) {
            $sql = "select Admin_password from admin where Admin_id='$username'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            
            // Verify the password
            if (password_verify($password,$row['Admin_password'])) {
                echo "Password is correct.";
            } else {
                header("location:login.php?wrongpassword=true");
            }
        }
        // Check if the username starts with "A"
        else if (strpos($username, "E") === 0) {
            $sql = "select Emp_password from employee_details where Emp_id='$username'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            
            // Verify the password
            if (password_verify($password,$row['Emp_password'])) {
                echo "Password is correct.";
            } else {
                header("location:login.php?wrongpassword=true");
            }
            
        }
    } else {
        echo "Username and/or password missing.";
    }
}
