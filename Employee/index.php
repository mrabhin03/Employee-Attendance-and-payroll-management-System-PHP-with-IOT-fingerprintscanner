<html>

<head>
    <link rel="stylesheet" href="Style.css?v=<?php echo time()?>">
    <link rel="stylesheet"  href="../common/Common_style.css?v=<?php echo time()?>">
    <title>Biometric attendance system</title>


</head>

<body>
    <?php
    include 'session_check.php';

    ?>
    <div class="top-bar">
        <img src="../images/logo.png" alt="Logo">
        <button onclick="logout()">Logout</button>
        <script>
            function logout() {
                window.location.href = 'logout.php';
            }
        </script>
    </div>
    <div class="main-body">
        <div class="side-menu">
            <ul>
                <li class="head">MENU</li>
                <li class="option"><a href="?page=home">DASHBOARD</a></li>
                <li class="option"><a href="?page=attendace">ATTENDANCE</a></li>
                <li class="option"><a href="?page=profile">PROFILE</a></li>
                <li class="option"><a href="?page=payroll">PAYROLL</a></li>
                <li class="option"><a href="?page=changepassword">CHANGE PASSWORD</a></li>
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
                include('home.php');
            }
            ?>
        </div>


    </div>

</body>

</html>