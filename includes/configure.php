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
    
    if(!isset($_SESSION['last_regeneration'])){
        regenerate_session_id();
    }else{
        $interval = 60 * 30;
        if(time() - $_SESSION['last_regeneration'] <= $interval){
        regenerate_session_id();
    }
}

    function regenerate_session_id(){
        session_regenerate_id();
            $_SESSION['last_regeneration'] = time();
    }

    function require_login(): void{
        if(!isset($_SESSION['username'])){
            header('../view/login.php');
            exit();
        }
    }   

?>
