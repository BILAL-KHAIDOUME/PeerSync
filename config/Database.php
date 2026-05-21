<?php

class Database {
    // ── Change these to match your MySQL settings ──
    private string $host     = "localhost";
    private string $dbname   = "eduquiz";
    private string $username = "root";
    private string $password = "";

    private ?PDO $connection = null;

    // Returns the PDO connection (creates it once)
    public function getConnection(): PDO {
        if ($this->connection === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            // Show errors instead of silent failure
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->connection;
    }
}
