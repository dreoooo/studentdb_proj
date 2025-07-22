<?php
require_once("db.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE token = :token AND is_verified = 0");
    $stmt->bindParam(":token", $token);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $update = $pdo->prepare("UPDATE users SET is_verified = 1, token = NULL WHERE token = :token");
        $update->bindParam(":token", $token);
        $update->execute();
        echo "✅ Email verified! You may now <a href='/My_File/studentdb_proj/login_form.php'>login</a>.";
    } else {
        echo "❌ Invalid or expired token.";
    }
} else {
    echo "⚠️ No token provided.";
}
