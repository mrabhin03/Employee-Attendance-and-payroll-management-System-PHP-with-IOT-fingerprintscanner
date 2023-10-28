<link rel="stylesheet" href="./changepassword/styleforchange.css">
<div class="changepassword">
<script src="./changepassword/scriptforchange.js"></script>
    <div class="change-container">
        <form onsubmit="return validation();" action="./changepassword/change.php" method="post">
            <h1>Enter the Current password</h1>
            <hr>
            <label for="cur-password">Current Password : </label>
            <input type="password" id="cur-password" placeholder="Password" name="cur-password" required>
            <br>
            <label id="cur-passwordinvalid" style="color: red;visibility: hidden;"></label>
            <br>
            <h1>Enter your new password</h1>
            <hr>
            <label for="new-password">New Password&ensp;&ensp;&ensp; : </label>
            <input type="password" id="new-password" placeholder="Password"
                name="new-password" required>
            <br>
            <label id="new-passwordinvalid" style="color: red;visibility: hidden;"></label>
            <br>
            <label for="con-password">Confirm Password : </label>
            <input type="password" id="con-password" placeholder="Password" name="password" required>
            <br>
            <label id="con-passwordinvalid" style="color: red;visibility: hidden;"></label>
            <br>
            <label id="same-password" style="color: red;visibility: hidden;">Two password should be same</label>
            <input type="submit" value="change" class="submit-button">
            <br>
            <?php
            if (isset($_GET["wrongpassword"]) && $_GET["wrongpassword"] === "true") {
                echo '<div id="wrongpassword" style="color:red;">Wrong Password Please try again....</div>';
            }
            if (isset($_GET["passwordchanged"]) && $_GET["passwordchanged"] === "true") {
                echo '<div id="passwordchanged" style="color:green;">Passsword changed successfully.</div>';
            }
            ?>
        </form>

    </div>


</div>
