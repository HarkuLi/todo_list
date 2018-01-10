<?php
use Harku\TodoList\Config\TaskConfig;
use Harku\TodoList\Service\TaskService;

// check required parameters
if (!isset($_POST["id"])) {
    http_response_code(400);
    die();
}

$taskService = new TaskService();

$id = $_POST["id"];
if ($taskService->getTask($id) === null) {
    http_response_code(400);
    die();
}

$endDate = date(TaskConfig::DATE_FORMAT);
$taskService->changeStatus($id, TaskConfig::TASK_FINISH, $endDate);
