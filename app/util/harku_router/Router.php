<?php
namespace app\util\harku_router;

use app\util\harku_router\MethodCallback as MethodCallback;

class Router
{
    public function __construct()
    {
        $this->defaultCallback = function () {
            include __DIR__."/default_page/404.html";
        };
    }

    public function use(string $path, Router $subRouter): void
    {
        $path = rtrim($path, "/");
        foreach ($subRouter->getPathMap() as $subPath => $methodCallback) {
            $this->pathMap[$path.$subPath] = $methodCallback;
        }
    }

    public function get(string $path, callable $callbackFunc): void
    {
        $path = rtrim($path, "/");
        if (!isset($this->pathMap[$path])) {
            $this->pathMap[$path] = new MethodCallback();
        }

        $this->pathMap[$path]->setGetCallback($callbackFunc);
    }

    public function post(string $path, callable $callbackFunc): void
    {
        $path = rtrim($path, "/");
        if (!isset($this->pathMap[$path])) {
            $this->pathMap[$path] = new MethodCallback();
        }

        $this->pathMap[$path]->setPostCallback($callbackFunc);
    }

    public function getPathMap(): iterable
    {
        return $this->pathMap;
    }

    public function defaultRoute(callable $callbackFunc): void
    {
        $this->defaultCallback = $callbackFunc;
    }

    public function listen(): void
    {
        //remove the query string
        $path = $_SERVER["REQUEST_URI"];
        $questionMarkPos = strpos($path, "?");
        if ($questionMarkPos) {
            $path = substr($path, 0, $questionMarkPos);
        }

        //remove the most right '/' chars
        $path = rtrim($path, "/");

        if (!isset($this->pathMap[$path])) {
            call_user_func($this->defaultCallback);
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $callback = $this->pathMap[$path]->getGetCallback();
            if ($callback === null) {
                call_user_func($this->defaultCallback);
                return;
            }

            $callback();
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $callback = $this->pathMap[$path]->getPostCallback();
            if ($callback === null) {
                call_user_func($this->defaultCallback);
                return;
            }

            $callback();
            return;
        }
    }

    /**
     * path(string) => MehodCallback
     */
    private $pathMap = array();

    private $defaultCallback;
}
