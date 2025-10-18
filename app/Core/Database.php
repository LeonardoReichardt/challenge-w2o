<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {

    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getInstance(): PDO {
        if(self::$instance === null) {
            try {
                $config = require __DIR__ . '/../../config/config.php';
                $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";

                self::$instance = new PDO($dsn, $config['db_user'], $config['db_pass'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } 
            catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: {$e->getMessage()}");
            }
        }

        return self::$instance;
    }

}