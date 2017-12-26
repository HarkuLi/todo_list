<?php
namespace app\router;

use harku_router\SubRouter as SubRouter;

class ARouter extends SubRouter
{
    public function setUpRouter(): void
    {
        $this->get("/home", function () {
            include __DIR__."/../view/page/home.html";
        });
    }
}
