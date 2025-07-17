<?php
declare(strict_types=1);

class Database {
    private string $host = "localhost";
    private string $dbname = "studentdb";
    private string $user = "root";
    private string $pass = "";
    public PDO $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $this->pdo = new PDO($dsn, $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
}
