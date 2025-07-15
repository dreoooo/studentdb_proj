<?php 
declare(strict_types=1);

function input_empty(string $username, string $password): bool {
    return empty($username) || empty($password);
}

function user_not_found(object $pdo, string $username): bool {
    return get_user($pdo, $username) === false;
}

function wrong_password(object $pdo, string $username, string $password): bool {
    $user = get_user($pdo, $username);
    if (!$user) return true;
    return !password_verify($password, $user["password"]);
}

function loggedin(object $pdo, string $username, string $password): bool {
    $user = get_user($pdo, $username);
    return $user && password_verify($password, $user["password"]);
}
