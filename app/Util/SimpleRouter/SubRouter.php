<?php
namespace Harku\TodoList\Util\SimpleRouter;

use Harku\TodoList\Util\SimpleRouter\Router as Router;

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

    public function staticResource(string $pathPat, string $matchPath): void
    {
        /**
         * This method is inherited from Router class.
         * To remove this method logically, it should be empty.
         */
    }
}
