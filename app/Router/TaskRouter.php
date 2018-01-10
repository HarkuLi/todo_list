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

        $this->post("/edit", function () {
            require __DIR__."/../Controller/Task/taskEdit.php";
        });

        $this->post("/update_content", function () {
            require __DIR__."/../Controller/Task/taskUpdateContent.php";
        });

        $this->get("/test", function () {
            require __DIR__."/../Controller/Task/test.php";
        });

        //Restful API
        $this->post("/finish", function () {
            require __DIR__."/../Controller/Task/taskFinish.php";
        });

        $this->post("/unfinish", function () {
            require __DIR__."/../Controller/Task/taskUnfinish.php";
        });

        $this->post("/del", function () {
            require __DIR__."/../Controller/Task/taskDelete.php";
        });
    }
}
