<div class="changepassword">
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
<style>
.change-container {
    padding: 20px;
    width: 50%;
    text-align: left;
}

h1 {
    text-align: center;
    color: #333;
}

input {
    width: 50%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.submit-button {
    width: 20%;
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    border: 1px solid #000;

}

.submit-button:hover {
    background-color: #2980b9;
}
</style>
<script>
function validation() {
    defaultView();
    var isCurPassValid = validatepass("cur-password", "cur-passwordinvalid");
    var isNewPassValid = validatepass("new-password", "new-passwordinvalid");
    var isConPassValid = validatepass("con-password", "con-passwordinvalid");
    
    
    if (isNewPassValid && isConPassValid) {
        var newPassword = document.getElementById("new-password").value;
        var confirmPassword = document.getElementById("con-password").value;

        if (newPassword !== confirmPassword) {
            document.getElementById("same-password").style.visibility = "visible";
            return false;
        }
    }

    return isCurPassValid && isNewPassValid && isConPassValid;
}

function validatepass(inputId, errorLabelId) {
    var errorText = "Invalid password: ";
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    var password = document.getElementById(inputId).value;

    if (password.trim().match(passw)) {
        return true;
    } else {
        if (password.length < 8) {
            errorText += "Password must be at least 8 characters long. ";
        } else if (!/[A-Z]/.test(password)) {
            errorText += "Password must contain at least one uppercase letter. ";
        } else if (!/[a-z]/.test(password)) {
            errorText += "Password must contain at least one lowercase letter. ";
        } else if (!/\d/.test(password)) {
            errorText += "Password must contain at least one digit. ";
        } else if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
            errorText += "Password must contain at least one special character. ";
        }
        document.getElementById(errorLabelId).innerHTML = errorText;
        document.getElementById(errorLabelId).style.visibility = "visible";
        document.getElementById(inputId).style.border = "solid 3px red";
        return false;
    }
}

function defaultView() {
    document.getElementById("cur-password").style.border = "1px solid #ccc";
    document.getElementById("cur-passwordinvalid").style.visibility = "hidden";
    document.getElementById("new-password").style.border = "1px solid #ccc";
    document.getElementById("new-passwordinvalid").style.visibility = "hidden";
    document.getElementById("con-password").style.border = "1px solid #ccc";
    document.getElementById("con-passwordinvalid").style.visibility = "hidden";
}
</script>