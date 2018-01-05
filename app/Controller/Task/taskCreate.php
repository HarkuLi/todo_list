<?php

use Harku\TodoList\Service\TaskService as TaskService;

if (!isset($_POST["title"])) {
    http_response_code(400);
    include __DIR__."/../../View/Page/400.html";
    die();
}

$taskService = new TaskService();
$taskService->create($_POST["title"]);

header("Location: /task", true, 303);
