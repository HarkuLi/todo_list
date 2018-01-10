<?php

use Harku\TodoList\Service\TaskService;
use Harku\TodoList\Config\TaskConfig;
use Harku\TodoList\Model\Task;

session_start();
$taskService = new TaskService();

//////////////////////
// query parameters //
//////////////////////

$title = null;
if (isset($_GET["title"])) {
    $title = $_GET["title"];
}

$status = TaskConfig::TASK_NOT_FINISH;
if (isset($_GET["status"])) {
    $status = (int)$_GET["status"];
}
if (!isset(TaskConfig::TASK_STATUS_TEXT[$status])) {
    http_response_code(400);
    include __DIR__."/../../View/Page/400.html";
    die();
}

$filter = new Task();
$filter->setTitle($title);
$filter->setStatus($status);
$pageNum = $taskService->getPageNum($filter);

$page = 1;
if (isset($_GET["page"])) {
    $page = (int)$_GET["page"];
}
if ($page < 1 || ($page > $pageNum && $page !== 1)) {
    http_response_code(404);
    include __DIR__."/../../View/Page/404.html";
    die();
}
$_SESSION[TaskConfig::SESSION_SRC_PAGE] = $page;

///////////////////
// generate page //
///////////////////

$taskList = $taskService->getPage($page, $filter);
$paginationStart = 1;
$paginationEnd = 1;

if ($page <= round(TaskConfig::PAGINATION_NUM / 2)) {
    $paginationStart = 1;
    $paginationEnd = TaskConfig::PAGINATION_NUM;
    if ($paginationEnd > $pageNum) {
        $paginationEnd = $pageNum;
    }
} else {
    $paginationEnd = (int)($page + floor(TaskConfig::PAGINATION_NUM / 2));
    if ($paginationEnd > $pageNum) {
        $paginationEnd = $pageNum;
    }
    $paginationStart = $paginationEnd - TaskConfig::PAGINATION_NUM + 1;
    /**
     * $paginationStart >= 1 surely
     * if $paginationStart < 1
     * $paginationEnd < PAGINATION_NUM
     * $page < PAGINATION_NUM - floor(PAGINATION_NUM / 2)
     *       <= round(PAGINATION_NUM / 2) (if PAGINATION_NUM is int)
     */
}

include __DIR__."/../../View/Page/task.php";
