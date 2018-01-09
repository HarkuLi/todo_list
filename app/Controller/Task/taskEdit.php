<?php
use Harku\TodoList\Service\TaskService;

if (!isset($_POST["id"])) {
    http_response_code(400);
    die();
}

$id = $_POST["id"];

$taskService = new TaskService();
$task = $taskService->getTask($id);
if ($task === null) {
    http_response_code(400);
    die();
}

include __DIR__."/../../View/Page/editTask.php";
