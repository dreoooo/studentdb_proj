<?php

    declare(strict_types= 1);
    
    require_once("../model/register_model.php");
    $errorMessage = "";
    $message = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $email = trim($_POST["email"]);
        $confirm_password = trim($_POST["confirm_password"]);
        $gender = trim($_POST["gender"]);
        $status = trim($_POST["status"]);

        if(empty($username) || empty($password) || empty($email) || empty($confirm_password) || empty($gender) || empty($status)){
            $errorMessage .= "Fill all fields!";
        }

        if(!empty($password)){

            if(strlen($password) < 8 ||
                !preg_match('/[A-Z]/', $password) || 
                !preg_match('/[a-z]/', $password) ||
                !preg_match('/[0-9]/', $password)){
                    $errorMessage .= "Password must be at least 8 characters and include an uppercase letter, a lowercase letter, and a number.<br>";
                }
        }

        if($password !== $confirm_password){
            $errorMessage .= "Password don't match.";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errorMessage .= "Invalid email!<br>";
        }

        if(empty($errorMessage)){

            try {
                if(is_user_exist( $pdo,  $username,  $email)){
                    $errorMessage = "Username or email is already used!<br>";
                }
                else{
                    $option = [
                        'cost' => 12
                    ];
                    $password = password_hash($password, PASSWORD_DEFAULT, $option);

                    set_user( $pdo,  $username,  $password,  $email,  $gender,  $status );

                    $message = "User Registered Successfully!";
                    $username = $email = $password = $confirm_password = $gender = $status = "";
                }
            } catch (PDOException $e) {
                die("Query Failed: " . $e->getMessage());
            }
        }
    }
