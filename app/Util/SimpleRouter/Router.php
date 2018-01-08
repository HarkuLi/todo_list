<?php
namespace Harku\TodoList\Util\SimpleRouter;

use Harku\TodoList\Util\SimpleRouter\MethodCallback as MethodCallback;

class Router
{
    public function __construct()
    {
        $this->defaultCallback = function () {
            include __DIR__."/DefaultPage/404.html";
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

    public function staticResource(string $pathPat, string $matchPath): void
    {
        if (!isset($this->staticMap[$pathPat])) {
            $this->staticMap[$pathPat] = new MethodCallback();
        }
        
        $this->staticMap[$pathPat]->setGetCallback(function () use ($matchPath) {
            $uri = $_SERVER["REQUEST_URI"];
            $uri = rtrim($uri, "/");

            $lastSlashPos = strrpos($uri, "/");
            if (!$lastSlashPos) {
                return;
            }
            $fileName = substr($uri, $lastSlashPos + 1);
            $actualPath = $matchPath.$fileName;

            readfile($actualPath);
        });
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

        //static resource
        foreach ($this->staticMap as $pathPat => $methodCallback) {
            if (preg_match($pathPat, $path)) {
                call_user_func($methodCallback->getGetCallback());
                return;
            }
        }

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
     * path{regex string} => MehodCallback
     */
    private $staticMap = array();

    /**
     * path{string} => MehodCallback
     */
    private $pathMap = array();

    private $defaultCallback;
}
