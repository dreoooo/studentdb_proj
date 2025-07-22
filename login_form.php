<?php
require_once("include/config_session.php");
require_once("view/login_view.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function togglePass(fieldId){
            const input = document.getElementById(fieldId);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</head>
<body>
    <h2>Login</h2>
    
    <form action="login_form.php" method="post">
        <input type="text" name="username" id="username" placeholder="Username"><br>

        <input type="password" name="password" id="password" placeholder="Password">
        <input type="checkbox" onclick="return togglePass('password')"><br>

        <button type="submit">Login</button>

        <p>Don't have an account? <a href="signup_form.php">Register</a></p>
    </form>

    <?php display_loginError(); ?>

</body>
</html>