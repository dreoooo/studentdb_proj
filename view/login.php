<?php
    require_once("../controller/login_contrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <script>
        function togglePassword(fieldId){
            const input = document.getElementById(fieldId);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</head>
<body>
    <h2>Login Form</h2>

    <?php if (!empty($errorMessage)) : ?>
        <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username"
        value="<?php echo htmlspecialchars($username ?? '') ?>"><br>

        <label for="password">Password: </label>
        <input type="password" name="password" id="password"
        value="<?php echo htmlspecialchars($password ?? '') ?>">
        <button type="button" onclick="togglePassword('password')">👁️</button><br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Sign up here</a></p>
</body>
</html>
