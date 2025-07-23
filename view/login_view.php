<?php
declare(strict_types=1);

function displayError(){
    if(isset($_SESSION["error"])){
        foreach($_SESSION["error"] as $error){
            echo "<p style='color:red'>" . htmlspecialchars($error) . "</p>";
        }
        unset($_SESSION["error"]);
    }
}