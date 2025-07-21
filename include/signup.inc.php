<?php
declare(strict_types=1);
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $email = strtolower($_POST["email"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $confirm_pass = trim($_POST["confirm_pass"] ?? '');
    $terms = isset($_POST["terms"]) ? 1 : 0;

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

        if(terms_not_checked( $terms)){
            $error["terms_not_checked"] = "You must agree to the Terms & Conditions!";
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

    create_user($pdo, $username, $email, $password, $terms);
    setSuccess("User Registered Successfully!");
    unset($_SESSION["signup_data"]);
    header("Location: login_form.php");
    exit();
}

