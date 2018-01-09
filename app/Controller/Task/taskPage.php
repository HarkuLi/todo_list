<?php

use Harku\TodoList\Service\TaskService as TaskService;
use Harku\TodoList\Config\TaskConfig as TaskConfig;

session_start();

$taskService = new TaskService();
$pageNum = $taskService->getPageNum();

//////////////////////
// query parameters //
//////////////////////

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

$taskList = $taskService->getPage($page);
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
