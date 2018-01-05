<?php
namespace Harku\TodoList\Router;

use Harku\TodoList\Util\SimpleRouter\SubRouter as SubRouter;

class TaskRouter extends SubRouter
{
    public function setUpRouter(): void
    {
        $this->get("/", function () {
            require __DIR__."/../Controller/Task/taskPage.php";
        });

        $this->get("/new", function () {
            require __DIR__."/../Controller/Task/taskNew.php";
        });

        $this->post("/create", function () {
            require __DIR__."/../Controller/Task/taskCreate.php";
        });

        $this->get("/test", function () {
            require __DIR__."/../Controller/Task/test.php";
        });
    }
}
