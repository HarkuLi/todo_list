<?php

use Harku\TodoList\Service\TaskService as TaskService;

$page = 1;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

$taskService = new TaskService();
$taskList = $taskService->getPage($page);
include __DIR__."/../../View/Page/task.php";
