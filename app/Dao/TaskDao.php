<?php
namespace Harku\TodoList\Dao;

use \PDO;

use Harku\TodoList\Dao\Connection as Connection;
use Harku\TodoList\Config\TaskConfig as TaskConfig;

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

    public function getRowNum(): int
    {
        $sql = "select count(id) from ".$this->tableName;
        $result = $this->connection->query($sql)->fetch();
        return $result["count(id)"];
    }

    public function read(int $page): iterable
    {
        $sql = "select * from ".
            $this->tableName.
            " order by start_date desc".
            " limit :skipNum, :selectNum";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":skipNum", $skipNum, PDO::PARAM_INT);
        $stmt->bindParam(":selectNum", $selectNum, PDO::PARAM_INT);

        $skipNum = TaskConfig::TASK_PER_PAGE * ($page-1);
        $selectNum = TaskConfig::TASK_PER_PAGE;
        $stmt->execute();

        return $stmt->fetchAll();
    }

    private $connection;
    private $tableName = "task";
}
