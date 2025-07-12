<?php
    declare(strict_types= 1);
    require_once("../includes/database.php");

    function is_user_exist(object $pdo, string $username, string $email){
        $query = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }   

    function set_user(object $pdo, string $username, string $password, string $email, string $gender, string $status ){
        
        try {
            $query = "INSERT INTO users(username, password, email, gender, civil_status)
                VALUES(:username, :password, :email, :gender, :status)";
        
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":gender", $gender, PDO::PARAM_STR_CHAR);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR_CHAR);
            $stmt->execute();

            $query = null;
            $stmt = null;

        } catch (PDOException $e) {
            die("Query Failed: ". $e->getMessage());
        }
    }