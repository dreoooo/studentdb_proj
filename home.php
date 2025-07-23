<?php
require_once("include/config_session.php");
if(!isset($_SESSION["username"])){
    header("Location: login_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Welcome User, <?php echo strtoupper(htmlspecialchars($_SESSION["username"])); ?>!</h2>
</body>
</html>