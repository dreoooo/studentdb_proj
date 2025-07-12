<?php
    declare(strict_types= 1);

    require_once("../includes/configure.php");
    $errorMessage = "";
    $username = "";
    $password = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST["username"] ?? '');
        $password = trim($_POST["password"] ?? '');

        if ($username === "" || $password === "") {
            $errorMessage = "Fill all fields!";
        }

        if (empty($errorMessage)) {
            require_once("../includes/database.php");

            try {
                $query = "SELECT * FROM users WHERE username = :username";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    if (!password_verify($password, $user["password"])) {
                        $errorMessage = "Invalid password or username.";
                    } else {
                        $_SESSION["username"] = $user["username"];
                        header("Location: ../view/home.php");
                        exit();
                    }
                } else {
                    $errorMessage = "Invalid password or username.";
                }
            } catch (PDOException $e) {
                die("Query Failed: " . $e->getMessage());
            }
        }
    }
?>
