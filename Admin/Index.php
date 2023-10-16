
<html>
<head>
    <title>The Admin Panel</title>
    <link rel="stylesheet"  href="CSS/Thestyle.css">
</head>

<body>

    <div class="top-bar">
        <img src="images/DPsq.png" alt="Logo">
    </div>
    <div class="main-body">
        <div class="side-menu">
            <ul>
                <li class="head">PAGES</li>
                <li class="option"><a href="?page=Dashboard">Dashboard</a></li>
                <li class="option"><a href="?page=Attendance">Attendance</a></li>
                <li class="option"><a href="?page=Employees">Employee</a></li>
            </ul>
        </div>
        <div class="main-content">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'] . '.php';
                if (file_exists($page)) {
                    include($page);
                } else {
                    echo "Page not found!";
                }
            } else {
                include('Dashboard.php'); 
            }
            ?>
        </div>


    </div>

</body>
<script src="javascript/Function.js"></script>

</html>