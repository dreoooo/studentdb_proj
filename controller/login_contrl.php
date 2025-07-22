<?php
declare(strict_types=1);

function input_empty(string $username, string $password): bool {
    return empty($username) || empty($password);
}

function invalid_user(object $pdo, string $username){
    return get_user( $pdo,  $username) === false;
}

function invalid_pass(object $pdo, string $password, string $username){
    $user = get_user($pdo, $username);
    if(!$user) return true;

    return $user && !password_verify($password, $user["password"]);
}

function login_user(object $pdo, string $username, string $password){
    $user = get_user($pdo, $username);
    return $user && password_verify($password, $user["password"]);
}

function setError($errormsg){
    $_SESSION["error"] = $errormsg;
}