<?php
require_once("../includes/login.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script>
        function togglePassword(fieldId){
            const input = document.getElementById(fieldId);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</head>
<body>
    <h2>Login</h2>

    <form action="login.php" method="post">
        <input type="text" name="username" id="username" placeholder="Username"
        value="<?php echo htmlspecialchars($username ?? '') ?>"><br>

        <input type="password" name="password" id="password" placeholder="Password">
        <button type="button" onclick="return togglePassword('password')">view</button><br>

        <button type="submit">Sign In</button>
    </form>

    <?php if(!empty($error)): ?>
        <div style="color:red">
            <?php foreach($error as $err): ?>
                <p><?php echo htmlspecialchars($err); ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <p>Don't have an account? <a href="register.php">Sign Up Here</a></p>
</body>
</html>
