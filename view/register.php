<?php
    require_once("../includes/register.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <input type="text" name="username" id="username" placeholder="Username"
        value="<?php echo htmlspecialchars($username ?? '') ?>"><br>

        <input type="text" name="email" id="email" placeholder="Email"
        value="<?php echo htmlspecialchars($email ?? '') ?>"><br>

        <select name="gender" id="gender">
            <option value="" disabled selected>Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <select name="status" id="status">
            <option value="" disabled selected>Status</option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
            <option value="Annulled">Annulled</option>
        </select>
        <br>

        <input type="password" name="password" id="password" placeholder="Password">
        <button type="button" onclick="return togglePassword('password')">view</button><br>

        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
        <button type="button" onclick="return togglePassword('confirm_password')">view</button><br>

        <button type="submit">Sign Up</button>

        <div id="errormsg" style="color:red;">
            <?php if(!empty($password)): ?>
                <?php foreach($error as $err): ?>
                    <p><?php echo htmlspecialchars($err); ?></p>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <?php if(empty($error)): ?>
            <p style="color:green"><?php echo htmlspecialchars($message); ?></p>
        <?php endif ?>

    </form>

        <p>Already have an account? <a href="login.php">Login Here</a></p>
</body>
</html>