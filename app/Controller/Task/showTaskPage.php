<?php

use Harku\TodoList\Service\TaskService as TaskService;

$page = $_GET["page"];
if (!$page) {
    $page = 1;
}

$taskService = new TaskService();
$taskList = $taskService->getPage($page);
include __DIR__."/../../View/Page/task.php";
