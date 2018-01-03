<?php
require_once __DIR__."/../vendor/autoload.php";

use Harku\TodoList\Util\SimpleRouter\Router as Router;
use Harku\TodoList\Router\TaskRouter as TaskRouter;

$rootRouter = new Router();

$taskRouter = new TaskRouter();
$rootRouter->use("/task", $taskRouter);

$rootRouter->listen();
