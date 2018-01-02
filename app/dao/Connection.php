<?php
namespace app\dao;

use \PDO;

use app\config\DBConfig as DBConfig;

class Connection
{
    public static function getConnection(): PDO
    {
        $conn = new PDO(
            "mysql:host=" . DBConfig::SERVER_NAME . ";dbname=" . DBConfig::DB_NAME,
            DBConfig::USERNAME,
            DBConfig::PASSWORD
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
