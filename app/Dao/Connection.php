<?php
namespace Harku\TodoList\Dao;

use \PDO;

use Harku\TodoList\Config\DBConfig as DBConfig;

class Connection
{
    /**
     * @throws PDOException
     */
    public static function getConnection(): PDO
    {
        $conn = new PDO(
            static::DSN,
            DBConfig::USERNAME,
            DBConfig::PASSWORD
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    private const DSN = "mysql:host=" . DBConfig::SERVER_NAME . ";dbname=" . DBConfig::DB_NAME;
}
