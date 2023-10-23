
<html>
<head>
    <title>The Admin Panel</title>
    <link rel="stylesheet"  href="CSS/THEstyle.css">
</head>

<body>

    <div class="top-bar">
        <img src="../images/DPsq.png" alt="Logo">
    </div>
    <div class="main-body">
        <div class="side-menu">
            <ul>
                <li class="head">PAGES</li>
                <li class="option"><a href="?page=Dashboard">Dashboard</a></li>
                <li class="option"><a href="?page=dailyadd">Daily Attendance</a></li>
                <li class="option"><a href="?page=Monthly_attendance">Monthy Attendance</a></li>
                <li class="option"><a href="?page=Employees">Employees</a></li>
                <li class="option"><a href="?page=Designations">Designations</a></li>
                <li class="option"><a href="?page=Calendar">Calendar</a></li>
                <li class="option"><a href="?page=Payrolls">Payroll</a></li>
            </ul>
        </div>
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
<script src="javascript/Functions.js"></script>

</html>