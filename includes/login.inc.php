<?php
declare(strict_types=1);

session_start();

require_once("database.php");
require_once("../controller/login_contrl.php");
require_once("../model/login_model.php");

$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if (input_empty($username, $password)) {
        $error[] = 'Fill all fields!';
    } elseif (user_not_found($pdo, $username)) {
        $error[] = 'User not found!';
        $username = $password = "";
    } elseif (wrong_password($pdo, $username, $password)) {
        $error[] = 'Invalid password!';
    } else {
        if (loggedin($pdo, $username, $password)) {
            $_SESSION['username'] = $username;
            header("Location: ../view/home.php");
            exit();
        } else {
            $error[] = 'Login failed!';
        }
    }
}
