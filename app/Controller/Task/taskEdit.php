<?php
use Harku\TodoList\Service\TaskService;
use Harku\TodoList\Util\ControllerUtil\JsonResponse;
use Harku\TodoList\Util\ControllerUtil\Parameter;

Parameter::required("id");
$id = $_POST["id"];

$taskService = new TaskService();
$task = $taskService->getTask($id);
if ($task === null) {
    JsonResponse::plain(
        ["msg" => "The id isn't existing."],
        400
    );
    die();
}

include __DIR__."/../../View/Page/editTask.php";
