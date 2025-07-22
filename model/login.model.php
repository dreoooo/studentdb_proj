<?php
declare(strict_types=1);

function get_user(object $pdo, string $username) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(["username" => $username]);
    return $stmt->fetch();
}