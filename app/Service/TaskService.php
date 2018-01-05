<?php
namespace Harku\TodoList\Service;

use Harku\TodoList\Dao\TaskDao as TaskDao;
use Harku\TodoList\Config\TaskConfig as TaskConfig;

class TaskService
{
    public function __construct()
    {
        $this->taskDao = new TaskDao();
    }

    public function getPageNum(): int
    {
        $rowNum = $this->taskDao->getRowNum();
        return ceil($rowNum / TaskConfig::TASK_PER_PAGE);
    }

    public function getPage(int $page): iterable
    {
        return $this->taskDao->read($page);
    }

    private $taskDao;
}
