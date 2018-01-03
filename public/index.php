<?php
require_once __DIR__."/../app/autoload.php";

use app\util\harku_router\Router as Router;
use app\router\TaskRouter as TaskRouter;

$rootRouter = new Router();

$taskRouter = new TaskRouter();
$rootRouter->use("/task", $taskRouter);

$rootRouter->listen();
