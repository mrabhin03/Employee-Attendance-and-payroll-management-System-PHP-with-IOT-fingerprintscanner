<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="login.js"></script>
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form  onsubmit="return validation();">
        Username : <input type="text" id="username" placeholder="Username" required>
            <br>
            <label id="usernameinvalid" style="color: red;visibility: hidden;">Invalid Username</label>
            <br>
            Password : <input type="password" id="password" placeholder="Password" required>
            <br>
            <label id="passwordinvalid" style="color: red;visibility: hidden;"></label>
            <br>
            <button type="submit" >Login</button>
            <br>
            <?php
            if (isset($_GET["wrongpassword"]) && $_GET["wrongpassword"] === "true") {
                echo '<div id="wrongpassword" style="color:red;">Wrong Password. Please try again.</div>';
            }
            ?>
        </form>
    </div>
</body>

</html>