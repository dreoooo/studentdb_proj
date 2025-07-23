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

    if (!$user) {
        echo "User not found.";
        exit();
    }

    if (!password_verify($password, $user["password"])) {
        echo "Password mismatch. Entered: $password, DB: " . $user["password"];
        exit();
    }

    return false;
}


function loggedIn(object $pdo, string $username, string $password) {
    $user = get_user( $pdo,  $username);
    return $user && password_verify($password, $user["password"]) !== false;
}

//SETERROR FUNCTION
function setError($err){
    $_SESSION["error"] = $err;
}