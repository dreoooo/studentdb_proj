<?php
    require_once("../includes/configure.php");
    require_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h2>Welcome User, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>

    <form action="../controller/logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
