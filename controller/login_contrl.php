<?php
    $errorMessage = "";
    $username = "";
    $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = trim($_POST["username"] ?? '');
        $password = trim($_POST['password'] ??'');

        try {
            require_once('../includes/database.php');

            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row){
                if(!password_verify($password, $row["password"])){
                    $errorMessage = "Invalid password, try again.";
                }else{
                    session_start();
                    $_SESSION["username"] = $row["username"];
                    header("Location: home.php");
                    exit();
                }
            }else{
                $errorMessage = "Invalid username or password!";
            }
        } catch (PDOException $e) {
            $errorMessage = "Database error: " . $e->getMessage();
        }
    }
?>
