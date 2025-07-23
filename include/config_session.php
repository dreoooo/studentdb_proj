<?php

    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_strict_mode", 1);

    define("SESSION_LIFETIME", 1800);
    define("SESSION_INTERVAL", 1800);

    session_set_cookie_params([
        "lifetime" => SESSION_LIFETIME,
        "domain" => "localhost",
        "path" => "/",
        "secure" => isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on",
        "httponly" => true
    ]);

    session_start();

    if(!isset($_SESSION["last_regeneration"])){
        regenerate_session_id();
    }else{
        if(time() - $_SESSION["last_regeneration"] > SESSION_INTERVAL){
            regenerate_session_id();
        }
    }

    function regenerate_session_id(){
        session_regenerate_id(true);
            $_SESSION["last_regeneration"] = time();
    }