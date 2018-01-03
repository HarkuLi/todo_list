<?php
namespace Harku\TodoList\Util\SimpleRouter;

/**
 * store callback functions for methods of a path
 * i.e. one function for get method and one function for post function
 */

class MethodCallback
{
    public function setGetCallback(callable $getCB): void
    {
        $this->getCallback = $getCB;
    }

    public function getGetCallback(): ?callable
    {
        return $this->getCallback;
    }

    public function setPostCallback(callable $postCB): void
    {
        $this->postCallback = $postCB;
    }

    public function getPostCallback(): ?callable
    {
        return $this->postCallback;
    }

    private $getCallback;
    private $postCallback;
}
