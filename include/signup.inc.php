<?php
declare(strict_types=1);
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username" ?? '']);
    $email = trim($_POST["email" ?? '']);
    $password = trim($_POST["password" ?? '']);
    $confirm_pass = trim($_POST["confirm_pass" ?? '']);

    require_once(__DIR__ . "/db.php");
    require_once(__DIR__ . "/../controller/signup_contrl.php");
    require_once(__DIR__ . "/../model/signup_model.php");
    require_once(__DIR__ . "/../view/signup_view.php");

    $error = [];

    if (input_empty($username, $email, $password, $confirm_pass)) {
        $error["input_empty"] = "Fill all fields!";
    } else {
        if (invalid_email($email)) {
            $error["invalid_email"] = "Invalid email!";
            $username = "";
        }
        if (invalid_password($password)) {
            $error["invalid_pass"] = "Invalid password!";
        }
        if (pass_not_match($password, $confirm_pass)) {
            $error["pass_not_match"] = "Passwords do not match!";
        }
        if (user_taken($pdo, $username)) {
            $error["user_taken"] = "Username is already taken!";
            $username = "";
        }
        if (email_taken($pdo, $email)) {
            $error["email_taken"] = "Email is already taken!";
            $email = "";
        }
    }

    if (!empty($error)) {
        setError($error);

        $_SESSION["signup_data"] = [
            "username" => $username,
            "email"=> $email
        ];

        header("Location: signup_form.php");
        exit();
    }

    create_user($pdo, $username, $email, $password);
    setSuccess("User Registered Successfully!");
    $_SESSION["signup_data"] = [];
    header("Location: signup_form.php");
    exit();
}
