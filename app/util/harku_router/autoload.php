<?php
namespace app\util\harku_router;

spl_autoload_register(function (string $className) {
    $className = ltrim($className, __NAMESPACE__);
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    require_once __DIR__ . $className . ".php";
});
