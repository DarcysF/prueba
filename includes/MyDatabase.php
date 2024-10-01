<?php
class MyDatabase {
    private $pdo;

    public function __construct() {
        $config = require __DIR__ . '/../config/database.php';
        try {
            $this->pdo = new PDO($config['dsn'], $config['user'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}
?>
