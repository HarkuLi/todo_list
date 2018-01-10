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
        $sql = "insert into $this->tableName (id, title, start_date, status)
            values (:id, :title, :start_date, :status)";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":id", $task->getId());
        $stmt->bindValue(":title", $task->getTitle());
        $stmt->bindValue(":start_date", $task->getStartDate());
        $stmt->bindValue(":status", $task->getStatus());
        $stmt->execute();
    }

    /**
     * @param Task $filter
     * @return integer total row number
     */
    public function getRowNum(Task $filter): int
    {
        $handledFilter = $this->filterHandler($filter);
        $whereStr = $handledFilter["whereStr"];
        $paramList = $handledFilter["paramList"];

        $sql = "select count(id) from $this->tableName ";
        if (strlen($whereStr)) {
            $sql .= "where $whereStr ";
        }

        $stmt = $this->connection->prepare($sql);
        for ($i=0; $i<count($paramList); ++$i) {
            $stmt->bindValue(":$i", $paramList[$i]["value"], $paramList[$i]["type"]);
        }
        $stmt->execute();
        
        $rst = $stmt->fetch();
        return $rst["count(id)"];
    }

    /**
     * @param string $id
     * @return Task|null
     */
    public function readOne(string $id): ?Task
    {
        $sql = "select * from $this->tableName
            where id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        $rst = $stmt->fetch();
        if (!$rst) {
            return null;
        }
        
        return new Task($rst);
    }

    /**
     * @param integer $page
     * @param Task $filter
     * @return iterable Task[]
     */
    public function readPage(int $page, Task $filter): iterable
    {
        $handledFilter = $this->filterHandler($filter);
        $whereStr = $handledFilter["whereStr"];
        $paramList = $handledFilter["paramList"];

        $sql = "select * from $this->tableName ";
        if (strlen($whereStr)) {
            $sql .= "where $whereStr ";
        }
        $sql .= "order by start_date desc
            limit :skipNum, :selectNum";
        
        $stmt = $this->connection->prepare($sql);
        for ($i=0; $i<count($paramList); ++$i) {
            $stmt->bindValue(":$i", $paramList[$i]["value"], $paramList[$i]["type"]);
        }
        $skipNum = TaskConfig::TASK_PER_PAGE * ($page-1);
        $stmt->bindValue(":skipNum", $skipNum, PDO::PARAM_INT);
        $selectNum = TaskConfig::TASK_PER_PAGE;
        $stmt->bindValue(":selectNum", $selectNum, PDO::PARAM_INT);
        $stmt->execute();

        $assocTaskList = $stmt->fetchAll();
        $taskList = [];
        foreach ($assocTaskList as $assocTask) {
            $taskList[] = new Task($assocTask);
        }
        
        return $taskList;
    }

    public function update(Task $task): void
    {
        $handledData = $this->dataHandler($task);
        $setStr = $handledData["setStr"];
        $paramList = $handledData["paramList"];

        $sql = "update $this->tableName
            set $setStr
            where id = :id";

        $stmt = $this->connection->prepare($sql);
        for ($i=0; $i<count($paramList); ++$i) {
            $stmt->bindValue(":$i", $paramList[$i]["value"], $paramList[$i]["type"]);
        }
        $stmt->bindValue(":id", $task->getId());
        $stmt->execute();
    }

    public function delete(string $id): void
    {
        $sql = "delete from $this->tableName
            where id = :id";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    /**
     * Handle task object and generate informations for db query.
     * Rule of parameter names: :0, :1, :2, ......
     *
     * @param Task $filter
     * @return iterable
     * [
     *      "whereStr" => string,
     *      "paramList" => array([
     *          "value" => mixed,
     *          "type" => PDO::PARAM_*
     *      ])
     * ]
     */
    private function filterHandler(Task $filter): iterable
    {
        $rst = [];
        $rst["whereStr"] = "";
        $rst["paramList"] = [];

        $title = $filter->getTitle();
        $status = $filter->getStatus();

        if ($title !== null && strlen($title)) {
            $rst["whereStr"] .= "title like :".count($rst["paramList"]);
            $rst["paramList"][] = ["value" => "%$title%", "type" => PDO::PARAM_STR];
        }
        if ($status !== null) {
            if (strlen($rst["whereStr"])) {
                $rst["whereStr"] .= " and ";
            }
            $rst["whereStr"] .= "status = :".count($rst["paramList"]);
            $rst["paramList"][] = ["value" => $status, "type" => PDO::PARAM_INT];
        }

        return $rst;
    }

    /**
     * Handle task object and generate informations for db query.
     * Rule of parameter names: :0, :1, :2, ......
     *
     * @param Task $task
     * @return iterable
     * [
     *      "setStr" => string,
     *      "paramList" => array([
     *          "value" => mixed,
     *          "type" => PDO::PARAM_*
     *      ])
     * ]
     */
    private function dataHandler(Task $task): iterable
    {
        $rst = [];
        $rst["setStr"] = "";
        $rst["paramList"] = [];

        $title = $task->getTitle();
        $startDate = $task->getStartDate();
        $endDate = $task->getEndDate();
        $status = $task->getStatus();

        if ($title !== null) {
            $rst["setStr"] .= "title = :".count($rst["paramList"]);
            $rst["paramList"][] = ["value" => $title, "type" => PDO::PARAM_STR];
        }
        if ($startDate !== null) {
            if (strlen($rst["setStr"])) {
                $rst["setStr"] .= ", ";
            }
            $rst["setStr"] .= "start_date = :".count($rst["paramList"]);
            $rst["paramList"][] = ["value" => $startDate, "type" => PDO::PARAM_STR];
        }
        if ($endDate !== null) {
            if (strlen($rst["setStr"])) {
                $rst["setStr"] .= ", ";
            }
            $rst["setStr"] .= "end_date = :".count($rst["paramList"]);
            $rst["paramList"][] = ["value" => $endDate, "type" => PDO::PARAM_STR];
        }
        if ($status !== null) {
            if (strlen($rst["setStr"])) {
                $rst["setStr"] .= ", ";
            }
            $rst["setStr"] .= "status = :".count($rst["paramList"]);
            $rst["paramList"][] = ["value" => $status, "type" => PDO::PARAM_INT];
        }

        return $rst;
    }

    private $connection;
    private $tableName = "task";
}
