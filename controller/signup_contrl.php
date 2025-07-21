<?php
declare(strict_types=1);

function input_empty(string $username, string $email, string $password, string $confirm_pass, int $terms): bool {
    return empty($username) || empty($email) || empty($password) || empty($confirm_pass) || empty($terms);
}

function invalid_email(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) === false;
}

function invalid_password(string $password): bool {
    return strlen($password) < 8 ||
        !preg_match("/[A-Z]/", $password) ||
        !preg_match("/[a-z]/", $password) ||
        !preg_match("/[0-9]/", $password);
}

function pass_not_match(string $password, string $confirm_pass): bool {
    return $password !== $confirm_pass;
}

function user_taken(object $pdo, string $username): bool {
    return get_user($pdo, $username) !== false;
}

function email_taken(object $pdo, string $email): bool {
    return get_email($pdo, $email) !== false;
}

function terms_not_checked(int $terms): bool {
    return $terms !== 1;
}

function create_user(object $pdo, string $username, string $email, string $password, int $terms): void {
    set_user($pdo, $username, $email, $password, $terms);
}

function setError(array $errorArray): void {
    $_SESSION["error"] = $errorArray;
}

function setSuccess(string $msg): void {
    $_SESSION["success"] = $msg;
}
