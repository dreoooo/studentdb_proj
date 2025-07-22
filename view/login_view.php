<?php
declare(strict_types=1);

function display_loginError(){
    if (isset($_SESSION["error"]) && is_array($_SESSION["error"])) {
        foreach ($_SESSION["error"] as $err) {
            echo "<p style='color:red;'>" . htmlspecialchars($err) . "</p>";
        }
        unset($_SESSION["error"]);
    }
}
