<?php 
    declare(strict_types= 1);

    function input_empty(string $name, string $email, string $password, string $confirm_password, string $gender, string $status){
        if(empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($gender) || empty($status)){
            return true;
        }else{
            return false;
        }
    }

    function invalid_email(string $email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    function invalid_password(string $password){
        if(strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password)){
            return true;
        }else{
            return false;
        }
    }

    function pass_not_match(string $password, string $confirm_password){
        if($password !== $confirm_password){
            return true;
        }else{
            return false;
        }
    }

    function username_taken(object $pdo, string $username){
        if(get_username( $pdo,  $username)){
            return true;
        }else{
            return false;
        }
    }

    function email_taken(object $pdo, string $email){
        if(get_email( $pdo,  $email)){
            return true;
        }else{
            return false;
        }
    }

    function create_user(object $pdo, string $username, string $password, string $email, string $gender, string $status){
        return set_user( $pdo,  $username,  $password,  $email,  $gender,  $status);
    }