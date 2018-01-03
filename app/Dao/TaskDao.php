<?php
namespace Harku\TodoList\Dao;

use \PDO;

use Harku\TodoList\Dao\Connection as Connection;
use Harku\TodoList\Config\DataConfig as DataConfig;

class TaskDao
{
    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function insert()
    {
        ;
    }

    public function read(int $page): iterable
    {
        $sql = "select * from ".
            $this->tableName.
            " limit 0, 10";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":skipNum", $skipNum, PDO::PARAM_INT);
        $stmt->bindParam(":selectNum", $selectNum, PDO::PARAM_INT);

        $skipNum = DataConfig::TASK_PER_PAGE * ($page-1);
        $selectNum = DataConfig::TASK_PER_PAGE;
        $stmt->execute();

        return $stmt->fetchAll();
    }

    private $connection;
    private $tableName = "task";
}
