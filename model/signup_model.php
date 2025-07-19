<?php
declare(strict_types=1);

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

function set_user(object $pdo, string $username, string $email, string $password): void {
    $stmt = $pdo->prepare("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)");
    $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
    $stmt->execute();
}
