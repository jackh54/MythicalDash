<?php
namespace MythicalDash\Chat;

use Exception;
use PDO;
use PDOException;


class Database {
    private $pdo;

    /**
     * Database constructor.
     *
     * @param string $dbType The type of the database (only 'mysql' or 'sqlite' are supported).
     * @param string $host The hostname or path to the database.
     * @param string $dbName The name of the database (not used for sqlite).
     * @param string|null $username The username for the database connection (not used for sqlite).
     * @param string|null $password The password for the database connection (not used for sqlite).
     *
     * @throws Exception If an unsupported database type is provided or the connection fails.
     */
    public function __construct($host, $dbName, $username = null, $password = null) {
        $dsn = "mysql:host=$host;dbname=$dbName";
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}