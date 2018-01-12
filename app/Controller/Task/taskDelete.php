<?php
use Harku\TodoList\Service\TaskService;
use Harku\TodoList\Util\ControllerUtil\JsonResponse;
use Harku\TodoList\Util\ControllerUtil\Parameter;

Parameter::required("id");

$taskService = new TaskService();
$taskService->delete($_POST["id"]);

$res = ["id" => $_POST["id"]];
JsonResponse::plain($res);
