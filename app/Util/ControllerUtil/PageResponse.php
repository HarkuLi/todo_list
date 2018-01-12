<?php
namespace Harku\TodoList\Util\ControllerUtil;

class PageResponse
{
    public static function badRequest(): void
    {
        http_response_code(400);
        include __DIR__."/Page/400.html";
    }

    public static function notFound(): void
    {
        http_response_code(404);
        include __DIR__."/Page/404.html";
    }

    public static function internalServerError(): void
    {
        http_response_code(500);
        include __DIR__."/Page/500.html";
    }
}
