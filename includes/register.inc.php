<?php 
        declare(strict_types= 1);

        require_once("database.php");
        require_once("../controller/register_contrl.php");
        require_once("../model/register_model.php");

        $error = [];
        $message = "";

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $username = trim($_POST["username"] ?? '');
            $email = trim($_POST["email"] ?? ''); 
            $gender = trim($_POST["gender"] ?? '');
            $status = trim($_POST["status"] ?? '');
            $password = trim($_POST["password"] ?? '');
            $confirm_password = trim($_POST["confirm_password"] ?? '');

            if(input_empty( $username,  $email,  $password,  $confirm_password, $gender, $status)){
                $error[] = "Fill all the fields!";
            }

            if(invalid_email( $email)){
                $error[] = "Invalid email!";
            }

            if(invalid_password( $password)){
                $error[] = "Invalid password";
            }

            if(pass_not_match( $password,  $confirm_password)){
                $error[] = "Password do not match";
            }

            if(username_taken( $pdo,  $username)){
                $error[] = "Username is already taken!";
            }

            if(email_taken( $pdo,  $email)){
                $error[] = "Email is already taken!";
            }

            if(empty($error)){
                try {
                    create_user( $pdo,  $username,  $password,  $email,  $gender,  $status);
                    $message = "User Registered Successfully!";
                    $username = $email = $password = $gender = $status = $confirm_password = "";
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
            }
        }