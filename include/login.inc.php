<?php
declare(strict_types=1);

require_once(__DIR__ . "/config_session.php");
require_once(__DIR__ . "/db.php");
require_once(__DIR__ . "/../controller/login_contrl.php");
require_once(__DIR__ . "/../model/login_model.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    //ERROR HANDLERS
    $error = [];
    
    if(input_empty( $username,  $password)){
        $error["input_empty"] = "Fill all fields!";
    }else{

        if(invalid_username( $pdo,  $username)){
            $error["invalid_username"] = "Invalid username!";
            $username = "";
        }

        if(invalid_pass( $pdo,  $username, $password)){
            $error["invalid_pass"] = "Invalid password!";
        }
    }

    if (loggedIn($pdo, $username, $password)) {
    $_SESSION["username"] = $username;
    header("Location: home.php");
    exit();
    } 
    else {
    setError(["login_failed" => "Incorrect username or password"]);
    header("Location: login_form.php");
    exit();
}

}