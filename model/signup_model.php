<?php

// Get user by username
function get_user(PDO $pdo, string $username): ?array {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false ? $result : null;
}

// Get user by email
function get_email(PDO $pdo, string $email): ?array {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false ? $result : null;
}

// Register new user
function set_user(PDO $pdo, string $username, string $email, string $password, int $terms): void {
    // Check if username or email is already used (only if verified)
    $existingUser = get_user($pdo, $username);
    if ($existingUser !== null && $existingUser['is_verified'] == 1) {
        throw new Exception("Username already taken.");
    }

    $existingEmail = get_email($pdo, $email);
    if ($existingEmail !== null && $existingEmail['is_verified'] == 1) {
        throw new Exception("Email already registered.");
    }

    // Reuse unverified account slot or insert new one
    $token = bin2hex(random_bytes(32));
    $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

    if ($existingUser !== null && $existingUser['is_verified'] == 0) {
        // Update unverified user
        $stmt = $pdo->prepare("
            UPDATE users SET email = :email, password = :password, terms_accepted = :terms, token = :token 
            WHERE username = :username
        ");
    } else {
        // Insert new user
        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password, terms_accepted, token, is_verified)
            VALUES (:username, :email, :password, :terms, :token, 0)
        ");
    }

    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
    $stmt->bindParam(":terms", $terms, PDO::PARAM_INT);
    $stmt->bindParam(":token", $token, PDO::PARAM_STR);
    $stmt->execute();

    send_verification_email($email, $token);
}

// Send verification email
function send_verification_email(string $email, string $token): void {
    $baseUrl = "http://localhost/My_File/login_system";
    $verifyUrl = $baseUrl . "/include/verify.php?token=" . urlencode($token);

    $subject = "Email Verification";
    $message = "
        <html>
        <head><title>Email Verification</title></head>
        <body>
            <p>Thank you for registering.</p>
            <p>Click the link to verify your email:</p>
            <p><a href=\"$verifyUrl\">Verify Email</a></p>
        </body>
        </html>
    ";

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: noreply@studentdb.test\r\n";

    mail($email, $subject, $message, $headers);
}
