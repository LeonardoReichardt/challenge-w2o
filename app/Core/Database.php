<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {

    private static $instance;
    private $connection;

    private $host = "localhost";
    private $db   = "challenge_w2o";
    private $user = "root";
    private $pass = "";
    private $charset = "utf8mb4";

    private function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        try {
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) {
            die("Erro de conexão com o banco: {$e->getMessage()}");
        }
    }

    public static function getInstance(): Database {
        if(!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
    
}