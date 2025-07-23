<?php
require_once("../include/db.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE token = :token AND is_verified = 0");
    $stmt->bindParam(":token", $token, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $update = $pdo->prepare("UPDATE users SET is_verified = 1, token = NULL WHERE token = :token");
        $update->bindParam(":token", $token, PDO::PARAM_STR);
        $update->execute();

        echo "<h2>✅ Email verified successfully!</h2>";
        echo "<p><a href='/My_File/login_system/login_form.php'>Go to login</a></p>";
    } else {
        echo "<h2>❌ Invalid or expired token.</h2>";
    }
} else {
    echo "<h2>⚠️ No token provided.</h2>";
}
