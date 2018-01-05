<?php
namespace Harku\TodoList\Dao;

use \PDO;

use Harku\TodoList\Dao\Connection as Connection;
use Harku\TodoList\Config\TaskConfig as TaskConfig;
use Harku\TodoList\Model\Task as Task;

class TaskDao
{
    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /**
     * create a task with id, title, start date, and status
     *
     * @param Task $task
     * @return void
     */
    public function create(Task $task): void
    {
        $sql = "insert into task (id, title, start_date, status)
            values (:id, :title, :start_date, :status)";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":id", $task->getId());
        $stmt->bindValue(":title", $task->getTitle());
        $stmt->bindValue(":start_date", $task->getStartDate());
        $stmt->bindValue(":status", $task->getStatus());
        $stmt->execute();
    }

    /**
     * @return integer total row number
     */
    public function getRowNum(): int
    {
        $sql = "select count(id) from ".$this->tableName;
        $result = $this->connection->query($sql)->fetch();
        return $result["count(id)"];
    }

    /**
     * @param integer $page
     * @return iterable an array including tasks of the page
     */
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
