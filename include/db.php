<?php

    $host = "localhost";
    $dbname = "myfirstdb";
    $dbuser = "root";
    $pass = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection Error: ". $e->getMessage());
    }   