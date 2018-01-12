<?php
use Harku\TodoList\Config\TaskConfig;
use Harku\TodoList\Service\TaskService;
use Harku\TodoList\Util\ControllerUtil\Parameter;

session_start();

Parameter::required("id", "title");
$id = $_POST["id"];
$title = $_POST["title"];

$taskService = new TaskService();
$taskService->updateContent($id, $title);

$location = $_SESSION[TaskConfig::SESSION_SRC_LOCATION] ?? "/task";
header("Location: $location", true, 303);
