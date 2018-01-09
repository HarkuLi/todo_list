<?php
namespace Harku\TodoList\Service;

use Ramsey\Uuid\Uuid as Uuid;

use Harku\TodoList\Dao\TaskDao as TaskDao;
use Harku\TodoList\Config\TaskConfig as TaskConfig;
use Harku\TodoList\Model\Task as Task;

class TaskService
{
    public function __construct()
    {
        $this->taskDao = new TaskDao();
    }

    /**
     * @param string $title
     * @return string id of created task
     */
    public function create(string $title): string
    {
        $task = new Task();
        $id = Uuid::uuid4()->toString();
        
        $task->setId($id);
        $task->setTitle($title);
        $task->setStartDate(date(TaskConfig::DATE_FORMAT));
        $task->setStatus(TaskConfig::TASK_NOT_FINISH);
        $this->taskDao->create($task);
        
        return $id;
    }

    /**
     * @return integer total page number
     */
    public function getPageNum(): int
    {
        $rowNum = $this->taskDao->getRowNum();
        return ceil($rowNum / TaskConfig::TASK_PER_PAGE);
    }

    /**
     * @param string $id
     * @return Task|null
     */
    public function getTask(string $id): ?Task
    {
        return $this->taskDao->readOne($id);
    }

    /**
     * @param integer $page
     * @return iterable an array including tasks of the page
     */
    public function getPage(int $page): iterable
    {
        return $this->taskDao->read($page);
    }

    public function updateContent(string $id, string $title): void
    {
        $task = new Task();
        $task->setId($id);
        $task->setTitle($title);
        $this->taskDao->update($task);
    }

    public function delete(string $id): void
    {
        $this->taskDao->delete($id);
    }

    private $taskDao;
}
