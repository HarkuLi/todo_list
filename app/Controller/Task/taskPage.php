<?php
use Harku\TodoList\Config\TaskConfig;
use Harku\TodoList\Model\Task;
use Harku\TodoList\Service\TaskService;
use Harku\TodoList\Util\ControllerUtil\PageResponse;

session_start();
//record current uri for coming back from edit page
$_SESSION[TaskConfig::SESSION_SRC_LOCATION] = $_SERVER["REQUEST_URI"];

$taskService = new TaskService();

//////////////////////
// query parameters //
//////////////////////

$title = $_GET["title"] ?? null;
$status = (int)($_GET["status"] ?? TaskConfig::TASK_NOT_FINISH);
$page = (int)($_GET["page"] ?? 1);

//////////////
// validate //
//////////////

if (!isset(TaskConfig::TASK_STATUS_TEXT[$status])) {
    PageResponse::badRequest();
    die();
}

$filter = new Task();
$filter->setTitle($title);
$filter->setStatus($status);
$pageNum = $taskService->getPageNum($filter);
if ($page < 1 || ($page > $pageNum && $page !== 1)) {
    PageResponse::notFound();
    die();
}

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

include __DIR__."/../../View/Task/Page/task.php";
