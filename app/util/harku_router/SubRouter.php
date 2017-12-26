<?php
namespace harku_router;

use harku_router\Router as Router;

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
