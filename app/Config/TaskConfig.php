<?php
namespace Harku\TodoList\Config;

class TaskConfig
{
    const TASK_NOT_FINISH = 0;
    const TASK_FINISH = 1;

    const TASK_PER_PAGE = 10;
    
    const TASK_STATUS_TEXT = array(
        self::TASK_NOT_FINISH => "not finished",
        self::TASK_FINISH => "finished"
    );
}
