<?php

set_exception_handler(function (Throwable $exception) {
    http_response_code(500);
    include __DIR__."/../View/Page/500.html";
    echo $exception->getMessage();
});
