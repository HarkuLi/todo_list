<?php
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../app/Controller/exceptionHandler.php";

use Harku\TodoList\Util\SimpleRouter\Router as Router;
use Harku\TodoList\Router\TaskRouter as TaskRouter;

$rootRouter = new Router();

$taskRouter = new TaskRouter();
$rootRouter->use("/task", $taskRouter);

$rootRouter->staticResource("/\/js\/.*/", __DIR__."/js/");
$rootRouter->staticResource("/\/css\/.*/", __DIR__."/css/");

$rootRouter->listen();
