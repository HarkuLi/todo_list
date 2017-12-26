<?php
namespace app\util\harku_router;

require_once __DIR__."/Router.php";

use \app\util\harku_router\Router as Router;

abstract class SubRouter extends Router
{
    public function __construct()
    {
        $this->setUpRouter();
    }

    /**
     * set every paths you want in this function
     */
    abstract public function setUpRouter(): void;
}
