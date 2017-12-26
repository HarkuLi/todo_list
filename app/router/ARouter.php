<?php
namespace app\router;

require_once __DIR__."/../util/harku_router/SubRouter.php";

use \app\util\harku_router\SubRouter as SubRouter;

class ARouter extends SubRouter
{
    public function setUpRouter(): void
    {
        $this->get("/home", function () {
            include __DIR__."/../view/page/home.html";
        });
    }
}
