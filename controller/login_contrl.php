<?php
declare(strict_types=1);

function input_empty(string $username, string $password): bool {
    return empty($username) || empty($password);
}

function invalid_username(object $pdo, string $username): bool {
    return get_user( $pdo,  $username) === false;
}

function invalid_pass(object $pdo, string $username, string $password) {
    $user = get_user($pdo, $username);

    if (!$user) return true;

    return $user && !password_verify($password, $user["password"]);
}

function user_not_found(object $pdo, string $username, string $password): bool {
    $user = get_user($pdo, $username);

    // User doesn't exist
    if ($user === null) {
        return true;
    }

    // User exists but password is wrong
    return !password_verify($password, $user["password"]);
}

function loggedIn(object $pdo, string $username, string $password) {
    $user = get_user( $pdo,  $username);
    return $user && password_verify($password, $user["password"]) !== false;
}

//SETERROR FUNCTION
function setError($err){
    $_SESSION["error"] = $err;
}