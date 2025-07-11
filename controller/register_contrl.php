<?php
    require_once("../model/register_model.php");
    $errorMessage = "";
    $message = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = trim($_POST["username"] ?? '');
        $email = trim($_POST['email'] ??'');
        $gender = trim($_POST['gender'] ??'');
        $status = trim($_POST['status'] ??'');
        $password = trim($_POST['password'] ??'');
        $confirm_password = trim($_POST['confirm_password'] ??'');

        if(empty($username) || empty($email) || empty($gender) || empty($status) || empty($password) || empty($confirm_password)){
            $errorMessage .= "Fill all fields!";
        }
        elseif($password != $confirm_password){
            $errorMessage .= "Password don't match";
        }
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errorMessage .= "Invalid email!";
            }
            else{
                
                try {
                    require_once("../includes/database.php");

                    if(is_user_exist($pdo, $username, $email)){
                        $errorMessage .= "Username or email is already used.";
                    }else{
                        $option  = [
                            'cost' => 12
                        ];
                        $password = password_hash($password, PASSWORD_DEFAULT, $option);

                        register_user($pdo, $username, $password, $email, $gender, $status);
                        $message = "User Registered Successfully!";

                        $username = $email = $gender = $status = $password = $confirm_password = "";
                    }

                } catch (PDOException $e) {
                    die("Query Failed: " . $e->getMessage());
                }
            }
        }

    }
?>