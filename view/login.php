<?php
    session_start();
    require_once("../controller/login_contrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script>
        function formValidate(){
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value.trim();
            const errormsg = document.getElementById("errormsg");

            errormsg.textContent = "";

            if(username === "" || password === ""){
                errormsg.textContent = "Fill all fields!";
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

    <h2>Login Form</h2>
    <form action="login.php" method="post" onsubmit="return formValidate()">
    
        <p id="errormsg" style="color:red"><?php echo $errorMessage ?? ''; ?></p>

        <label for="username">Username: </label>
        <input type="text" name="username" id="username"
        value="<?php echo htmlspecialchars($username ?? '') ?>"><br>

        <label for="password">Password: </label>
        <input type="password" name="password" id="password"
        value="<?php echo htmlspecialchars($password ?? '') ?>"><br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
