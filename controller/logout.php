<?php
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        session_unset();
        session_destroy();
        header("Location: ../view/login.php");
        exit();
    }
    else{
        header("Location: ../view/login.php");
        exit();
    }
?>
