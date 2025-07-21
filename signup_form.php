<?php
require_once("include/signup.inc.php");
require_once("view/signup_view.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</head>
<body>
    <h2>Register</h2>

    <form action="signup_form.php" method="post">
        <input type="text" name="username" id="username" placeholder="Username"
            value="<?php echo htmlspecialchars($_SESSION["signup_data"]["username"] ?? '') ?>"><br>

        <input type="text" name="email" id="email" placeholder="Email"
            value="<?php echo htmlspecialchars($_SESSION["signup_data"]["email"] ?? '') ?>"><br>

        <input type="password" name="password" id="password" placeholder="Password">
        <input type="checkbox" onclick="return togglePassword('password')"><br>

        <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password">
        <input type="checkbox" onclick="return togglePassword('confirm_pass')"><br><br>

        <button type="submit">Sign Up</button><br><br>

        <label for="terms">
            <input type="checkbox" name="terms" id="terms"> I agree to the Terms & Conditions
        </label>
        
        <p>Already have an account? <a href="login_form.php">Login</a></p>
    </form>

    <?php displayError(); ?>
    <?php unset($_SESSION["signup_data"]); ?>
</body>
</html>
