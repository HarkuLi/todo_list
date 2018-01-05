<?php
namespace Harku\TodoList\Config;

class TaskConfig
{
    const TASK_NOT_FINISH = 0;
    const TASK_FINISH = 1;

    const TASK_PER_PAGE = 10;
    
    const DATE_FORMAT = "Y-m-d H:i:s";

    const TASK_STATUS_TEXT = array(
        self::TASK_NOT_FINISH => "not finished",
        self::TASK_FINISH => "finished"
    );

    const PAGINATION_NUM = 9;
}
