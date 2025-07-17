<?php
require_once("../includes/register.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script>
        function togglePassword(fieldId){
            const input = document.getElementById(fieldId);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</head>
<body>
    <h2>Register</h2>

    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username"
            value="<?php echo htmlspecialchars($_POST['username'] ?? '') ?>"><br>

        <input type="text" name="email" placeholder="Email"
            value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>"><br>

        <input type="password" name="password" id="password" placeholder="Password">
        <button type="button" onclick="togglePassword('password')">👁️</button><br>

        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
        <button type="button" onclick="togglePassword('confirm_password')">👁️</button><br>

        <button type="submit">Sign Up</button>
    </form>

    <?php if (!empty($registerController->msg)): ?>
        <div style="color: <?php echo str_starts_with($registerController->msg, '✅') ? 'green' : 'red'; ?>;">
            <p><?php echo htmlspecialchars($registerController->msg); ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
