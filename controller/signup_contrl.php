<?php
declare(strict_types=1);

// Check if required inputs are empty
function input_empty(string $username, string $email, string $password, string $confirm_pass, int $terms): bool {
    return empty($username) || empty($email) || empty($password) || empty($confirm_pass) || empty($terms);
}

// Check for invalid email format
function invalid_email(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) === false;
}

// Check if password is weak
function invalid_password(string $password): bool {
    return strlen($password) < 8 ||
        !preg_match("/[A-Z]/", $password) ||
        !preg_match("/[a-z]/", $password) ||
        !preg_match("/[0-9]/", $password);
}

// Check if password and confirmation do not match
function pass_not_match(string $password, string $confirm_pass): bool {
    return $password !== $confirm_pass;
}

// Check if username is already taken
function user_taken(object $pdo, string $username): bool {
    return get_user($pdo, $username) !== null;
}

// Check if email is already used
function email_taken(object $pdo, string $email): bool {
    return get_email($pdo, $email) !== null;
}

// Check if terms checkbox was not checked
function terms_not_checked(int $terms): bool {
    return $terms !== 1;
}

// Final user creation function
function create_user(object $pdo, string $username, string $email, string $password, int $terms): void {
    set_user($pdo, $username, $email, $password, $terms);
}

// Set error message array in session
function setError(array $errorArray): void {
    $_SESSION["error"] = $errorArray;
}

// Set success message in session
function setSuccess(string $msg): void {
    $_SESSION["success"] = $msg;
}
