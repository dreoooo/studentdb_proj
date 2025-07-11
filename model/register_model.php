<?php 
require_once("../includes/database.php");
require_once("../controller/register_contrl.php");

function is_user_exist($pdo, $username, $email) {
    $query = "SELECT * FROM users WHERE username = :username OR email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function register_user($pdo, $username, $password, $email, $gender, $status) {
    $query = "INSERT INTO users(username, password, email, gender, civil_status)
            VALUES(:username, :password, :email, :gender, :status)";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->execute();

    $query = null;
    $stmt = null;
}
?>
