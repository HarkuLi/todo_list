<?php
namespace app\service;

use app\dao\TaskDao as TaskDao;

class TaskService
{
    public function __construct()
    {
        $this->taskDao = new TaskDao();
    }

    public function getPage(int $page): iterable
    {
        return $this->taskDao->read($page);
    }

    private $taskDao;
}
