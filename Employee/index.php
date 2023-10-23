<html>

<head>
    <link rel="stylesheet" href="style.css">
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
                <li class="option"><a href="?page=page1">Page 1</a></li>
                <li class="option"><a href="?page=page2">Page 2</a></li>
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
                include('page1.php');
            }
            ?>
        </div>


    </div>

</body>

</html>