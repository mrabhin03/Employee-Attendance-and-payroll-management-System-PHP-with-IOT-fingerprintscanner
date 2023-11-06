<html>

<head>
    <title>The Admin Panel</title>
    <link rel="stylesheet" href="CSS/Style.css?v=<?php echo time()?>">
    <link rel="stylesheet" href="../common/Common_style.css?v=<?php echo time()?>">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include 'session_check.php';
    include '../common/connection.php';
    $checkno="SELECT Emp_id FROM employee_details WHERE Emp_status='101'";
    $count=$con->query($checkno)->num_rows;

    ?>
    <div class="top-bar">
        <button onclick="logout()" Style='float:right;'>Logout</button>
        <script>
        function logout() {
            window.location.href = 'logout.php';
        }
        </script>
    </div>
    <div class="main-body">
        <div class="side-menu">
            <ul>
                <li style="order:1" class="head">PAGES</li>
                <li style="order:3" class="option"><a href="?page=Dashboard">Dashboard</a></li>
                <li style="order:4" class="option">
                    <span onclick="opendata()">Attendance <span class="icon">
                            <ion-icon class="down" name="caret-down-outline">
                        </span></span>
                    <ul class="sub_tree">
                        <li class="option"><a href="?page=Attendance">Daily Attendance</a></li>
                        <li class="option"><a href="?page=Monthly_attendance">Monthy Attendance</a></li>
                    </ul>
                </li>
                <li style="order:5" class="option"><a href="?page=Employees">Employees </a></li>
                <li style="order:6" class="option"><a href="?page=Designations">Designations</a></li>
                <li style="order:7" class="option"><a href="?page=Payrolls">Payroll</a></li>
                <li style="order:8" class="option"><a href="?page=Calendar">Calendar</a></li>
                <li style="order:10" class="option"><a href="?page=changepassword">Changepassword</a></li>
                <?php if($count==0)
                { ?>
                <li style="order:11" class="option"><a href="?page=Notifications">Notifications</a></li>
                <?php 
                }
                else
                { ?>
                <li style="order:2" class="option"><a href="?page=Notifications">Notifications <div style="border-radius:50%;height:20px; width:20px; margin-top:-20px; margin-left:5px; background-color:red; font-size:55%; display:flex; align-items:center; justify-content:center; color:white;"><b><?php echo $count; ?></b></div> </a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <script>
        function opendata() {
            const liview = document.querySelector('.icon');
            const liviewicon = document.querySelector('.sub_tree');
            if (liview.classList.contains('active')) {
                liview.classList.remove('active');
                liviewicon.classList.remove('active');
            } else {
                liview.classList.add('active');
                liviewicon.classList.add('active');
            }
        }
        </script>
        <div class="main-content">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'] . '.php';
                if (file_exists($page)) {
                    include($page);
                } 
                else 
                {
                    if(file_exists("Edit_page/$page"))
                    {
                        include("Edit_page/$page");
                    }
                    else
                    {
                        if(file_exists("Edit_code/$page"))
                        {
                            include("Edit_code/$page");
                        }
                        else
                        {
                            echo "Page not found!";
                        }
                        
                    }
                }
            } 
            else 
            {
                include('Dashboard.php'); 
            }
            ?>
        </div>


    </div>

</body>
<script src="javascript/Functions.js?v=<?php echo time()?>"></script>

</html>