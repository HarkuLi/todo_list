<?php
require_once __DIR__."/../app/util/harku_router/Router.php";
require_once __DIR__."/../app/router/ARouter.php";

use \app\util\harku_router\Router as Router;
use \app\router\ARouter as ARouter;

$rootRouter = new Router();

$aRouter = new ARouter();
$rootRouter->use("/a", $aRouter);

$rootRouter->listen();
