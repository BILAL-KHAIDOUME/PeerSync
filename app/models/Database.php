<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Database Connection Manager
 * Handles all database operations with prepared statements
 */
class Database {
    private string $host = "localhost";
    private string $dbname = "peersync";
    private string $username = "root";
    private string $password = "";
    private ?PDO $connection = null;

    /**
     * Get PDO connection instance
     */
    public function connect(): PDO {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
                $this->connection = new PDO($dsn, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Database Connection Error: " . $e->getMessage());
            }
        }
        return $this->connection;
    }

    /**
     * Execute a prepared statement
     */
    public function execute(string $sql, array $params = []): bool {
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Fetch single row
     */
    public function fetchOne(string $sql, array $params = []): ?array {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch() ?: null;
    }

    /**
     * Fetch all rows
     */
    public function fetchAll(string $sql, array $params = []): array {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Get last insert ID
     */
    public function lastInsertId(): string {
        return $this->connect()->lastInsertId();
    }

    /**
     * Begin transaction
     */
    public function beginTransaction(): void {
        $this->connect()->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public function commit(): void {
        $this->connect()->commit();
    }

    /**
     * Rollback transaction
     */
    public function rollBack(): void {
        $this->connect()->rollBack();
    }
}
