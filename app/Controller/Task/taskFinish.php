<?php
use Harku\TodoList\Config\TaskConfig;
use Harku\TodoList\Service\TaskService;
use Harku\TodoList\Util\ControllerUtil\JsonResponse;
use Harku\TodoList\Util\ControllerUtil\Parameter;

Parameter::required("id");
$id = $_POST["id"];

$taskService = new TaskService();
if ($taskService->getTask($id) === null) {
    JsonResponse::plain(
        ["msg" => "The id isn't existing."],
        400
    );
    die();
}

$endDate = date(TaskConfig::DATE_FORMAT);
$taskService->changeStatus($id, TaskConfig::TASK_FINISH, $endDate);
