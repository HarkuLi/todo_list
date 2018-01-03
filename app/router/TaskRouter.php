<?php
namespace app\router;

use app\util\harku_router\SubRouter as SubRouter;

class TaskRouter extends SubRouter
{
    public function setUpRouter(): void
    {
        $this->get("/", function () {
            require __DIR__."/../controller/task/showTaskPage.php";
            //include __DIR__."/../view/page/home.html";
        });

        $this->get("/test", function () {
            echo "test";
        });
    }
}
