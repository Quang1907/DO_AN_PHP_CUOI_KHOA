<?php

namespace Core;

use Exception;
use PDO;

class Connection
{
    private $host = null;
    private $userName = null;
    private $password = null;
    private $dbName = null;
    static private $instance = null;

    private function __construct()
    {
        $this->host = env("DB_HOST");
        $this->dbName = env("DB_DATATBASE");
        $this->userName = env("DB_USERNAME");
        $this->password = env("DB_PASSWORD");
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            self::$instance = new PDO($dsn, $this->userName, $this->password, $options);
        } catch (Exception $ex) {
            Error::render(["error" => $ex->getMessage()], "Exception");
            die();
        }
    }

    static public function getInstance()
    {
        // global $config;
        // if (!empty($config['database'])) {
        // $configDb = $config['database'];
        if (empty(self::$instance)) {
            new Connection();
        }
        return self::$instance;
        // }
        // Error::render(["error" => "Error: Khong tim thay cau hinh database"], "database");
        // die();
    }
}
