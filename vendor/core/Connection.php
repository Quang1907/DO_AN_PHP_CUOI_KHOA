<?php

namespace Core;

use Exception;
use PDO;

class Connection
{
    static private $instance = null;
    private function __construct($configDb)
    {
        try {
            $dsn = "mysql:host=" . $configDb['host'] . ";dbname=" . $configDb['dbname'];
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            self::$instance = new PDO($dsn, $configDb['user'], $configDb['password'], $options);
        } catch (Exception $ex) {
            Error::render(["error" => $ex->getMessage()], "Exception");
            die();
        }
    }

    static public function getInstance()
    {
        global $config;
        if (!empty($config['database'])) {
            $configDb = $config['database'];
            if (empty(self::$instance)) {
                new Connection($configDb);
            }
            return self::$instance;
        }
        Error::render(["error" => "Error: Khong tim thay cau hinh database"], "database");
        die();
    }
}
