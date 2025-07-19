<?php
declare(strict_types=1);

function displayError(): void {
    if (isset($_SESSION["error"])) {
        foreach ($_SESSION["error"] as $error) {
            echo "<p style='color:red'>$error</p>";
        }
        unset($_SESSION["error"]);
    }
}

function displaySuccess(): void {
    if (isset($_SESSION["success"])) {
        echo "<p style='color:green'>" . $_SESSION["success"] . "</p>";
        unset($_SESSION["success"]);
    }
}
