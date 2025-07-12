<?php 
    require_once("../controller/register_contrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <script>
        function validateForm(){
            const username = document.getElementById("username").value.trim();
            const email = document.getElementById("email").value.trim();
            const gender = document.getElementById("gender");
            const status = document.getElementById("status");
            const password = document.getElementById("password").value.trim();
            const confirm_password = document.getElementById("confirm_password").value.trim();
            const errormsg =document.getElementById("errormsg");

            errormsg.textContent = "";

            if(username === "" || email === "" || gender === "" || status === "" || password === "" || confirm_password === "" ){
                errormsg.textContent = "Fill all fields!";
                return false;
            }else{
                return confirm("Register User?");
            }
        }

        function togglePassword(fieldId){
            const input = document.getElementById(fieldId);
            input.type = input.type === "password" ? "text" : "password";
        }

    </script>
</head>
<body>
    <h2>Registration Form</h2>

    <p id="errormsg" style="color:red"><?php echo $errorMessage; ?></p>
    <p style="color:green"><?php echo $message; ?></p>

    <form action="register.php" method="post" onsubmit="return validateForm()" autocomplete="off">

        <label for="username">Enter username:</label>
        <input type="text" name="username" id="username"
        value="<?php echo htmlspecialchars($username ?? '') ?>"><br>

        <label for="email">Enter email:</label>
        <input type="text" name="email" id="email"
        value="<?php echo htmlspecialchars($email ?? '')?>"><br>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="Other">Other</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label for="status">Civil status:</label>
        <select name="status" id="status">
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
            <option value="Annulled">Annulled</option>
        </select>
        <br>

        <label for="password">Enter password:</label>
        <input type="password" name="password" id="password"
        value="<?php echo htmlspecialchars($password ?? '') ?>">
        <button type="button" onclick="togglePassword('password')">👁️</button><br>

        <label for="confirm_password">Confirm password:</label>
        <input type="password" name="confirm_password" id="confirm_password"
        value="<?php echo htmlspecialchars($confirm_password ?? '') ?>">
        <button type="button" onclick="togglePassword('confirm_password')">👁️</button><br>

        <button type="submit">Register</button>
    </form>

    <div>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>