<?php 

    $host = "localhost";
    $dbname = "studentdb";
    $dbuser = "root";
    $dbpass = "";

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {     
        error_log($e->getMessage());
        die("Connection Error...");
    }