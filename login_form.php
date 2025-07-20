<?php
session_start();
require_once("view/signup_view.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Login</h2>

    <?php displaySuccess(); ?>
    
    <form action="login_form.php" method="post">
        <input type="text" name="username" id="username" placeholder="Usernam"><br>

        <input type="password" name="password" id="password" placeholder="Password"><br>

        <button type="submit">Login</button>
    </form>

    <?php displaySuccess(); ?>

</body>
</html>