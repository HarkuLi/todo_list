<?php
use Harku\TodoList\Util\ControllerUtil\PageResponse;

set_exception_handler(function (Throwable $exception) {
    PageResponse::internalServerError();
    echo $exception->getMessage();
});
