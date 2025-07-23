<?php
// signup_model.php
function get_user(object $pdo, string $username) {
    $stmt = $pdo->prepare("SELECT username FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_email(object $pdo, string $email) {
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function set_user(object $pdo, string $username, string $email, string $password, int $terms): void {
    $token = bin2hex(random_bytes(32));
    $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

    $stmt = $pdo->prepare("INSERT INTO users(username, email, password, terms_accepted, token, is_verified) 
                        VALUES(:username, :email, :password, :terms, :token, 0)");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
    $stmt->bindParam(":terms", $terms, PDO::PARAM_STR);
    $stmt->bindParam(":token", $token, PDO::PARAM_STR);
    $stmt->execute();

    send_verification_email($email, $token);
}

function send_verification_email($email, $token) {
    $subject = "Email Verification";
    $verifyUrl = "http://localhost/My_File/studentdb_proj/include/verify.php?token=" . urlencode($token);
    $message = "Click the link to verify your email: <a href=\"" . $verifyUrl . "\">Verify Email</a>";
    $headers = "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: noreply@studentdb.test";
    mail($email, $subject, $message, $headers);
}
