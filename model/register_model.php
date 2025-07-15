<?php 
    declare(strict_types= 1);

    function get_username(object $pdo, string $username){
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_email(object $pdo, string $email){
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function set_user(object $pdo, string $username, string $password, string $email, string $gender, string $status){
        $query = "INSERT INTO users(username, password, email, gender, civil_status)
                VALUES(:username, :password, :email, :gender, :status)";
        $stmt = $pdo->prepare($query);
        $option = [
            'cost' => 12
        ];
        $password_hashed = password_hash($password, PASSWORD_DEFAULT, $option);

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password_hashed, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }