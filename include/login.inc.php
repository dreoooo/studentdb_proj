<?php
declare(strict_types=1);
require_once("config_session.php");
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once(__DIR__ . "/db.php");
    require_once(__DIR__ . "/../controller/login_contrl.php");
    require_once(__DIR__ . "/../model/login_model.php");

    //ERRORS
    $error = [];

    if(input_empty( $username,  $password)){
        $error["input_empty"] = "Fill all fields!";
    }
    else{
        if(invalid_user($pdo, $username)){
            $error["invalid_user"] = "Invalid user!";
        }
        
        if(invalid_pass($pdo, $password, $username)){
            $error["invalid_pass"] = "Invalid password!";
        }
    }

    if(!empty($error)){
        setError($error);

        $_SESSION["login_data"] = [
            "username" => $username
        ];

        header("Location: login_form.php");
        exit();
    }

    login_user( $pdo,  $username,  $password);
    $_SESSION["username"] = $username;
    unset($_SESSION["login_data"]);
    header("Location: home.php");
    exit();
}