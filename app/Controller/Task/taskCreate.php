<?php
use Harku\TodoList\Service\TaskService;
use Harku\TodoList\Util\ControllerUtil\Parameter;

Parameter::required("title");

$taskService = new TaskService();
$taskService->create($_POST["title"]);

header("Location: /task", true, 303);
