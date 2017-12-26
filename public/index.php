<?php
require_once __DIR__."/../app/util/harku_router/autoload.php";
// /app/router need an autoloader
require_once __DIR__."/../app/router/ARouter.php";

use harku_router\Router as Router;
use app\router\ARouter as ARouter;

$rootRouter = new Router();

$aRouter = new ARouter();
$rootRouter->use("/a", $aRouter);

$rootRouter->listen();
