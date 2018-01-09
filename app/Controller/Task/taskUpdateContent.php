<?php
use Harku\TodoList\Service\TaskService;
use Harku\TodoList\Config\TaskConfig;

session_start();

if (!isset($_POST["id"]) || !isset($_POST["title"])) {
    http_response_code(400);
    die();
}
$id = $_POST["id"];
$title = $_POST["title"];

$taskService = new TaskService();
$taskService->updateContent($id, $title);

$location = "/task";
if (isset($_SESSION[TaskConfig::SESSION_SRC_PAGE])) {
    $location .= "?page=".$_SESSION[TaskConfig::SESSION_SRC_PAGE];
}
header("Location: $location", true, 303);
