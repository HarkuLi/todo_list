<?php
use Harku\TodoList\Service\TaskService;

$taskService = new TaskService();
$taskService->delete($_POST["id"]);

header("Content-Type: application/json");
$res = ["id" => $_POST["id"]];
echo json_encode($res);
