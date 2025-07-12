<?php
    declare(strict_types= 1);
    
    session_set_cookie_params([
        'lifetime' => 1800, // 30 mins
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict'
    ]);

    session_start();
    session_regenerate_id(true); 

?>
