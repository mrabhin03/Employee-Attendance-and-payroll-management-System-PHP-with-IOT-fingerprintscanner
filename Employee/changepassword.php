<link rel="stylesheet" href="./changepassword/styleforchange.css">
<div class="changepassword">
<script src="./changepassword/scriptforchange.js"></script>
    <div class="change-container">
        <form onsubmit="return validation();" method="post">
            <h1>Enter the Current password</h1>
            <hr>
            Current Password : <input type="password" id="cur-password" placeholder="Password" name="password" required>
            <br>
            <label id="cur-passwordinvalid" style="color: red;visibility: hidden;"></label>
            <br>
            <h1>Enter your new password</h1>
            <hr>
            New Password&ensp;&ensp;&ensp;: <input type="password" id="new-password" placeholder="Password"
                name="password" required>
            <br>
            <label id="new-passwordinvalid" style="color: red;visibility: hidden;"></label>
            <br>
            Confirm Password : <input type="password" id="con-password" placeholder="Password" name="password" required>
            <br>
            <label id="con-passwordinvalid" style="color: red;visibility: hidden;"></label>
            <br>
            <label id="same-password" style="color: red;visibility: hidden;">Two password should be same</label>
            <input type="submit" value="change" class="submit-button">
        </form>

    </div>


</div>
