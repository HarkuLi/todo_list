<?php
use Harku\TodoList\Service\TaskService;

if (!isset($_POST["id"]) || !isset($_POST["title"])) {
    http_response_code(400);
    die();
}
$id = $_POST["id"];
$title = $_POST["title"];

$taskService = new TaskService();
$taskService->updateContent($id, $title);

header("Location: /task", true, 303);
