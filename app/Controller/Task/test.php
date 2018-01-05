<?php

use Harku\TodoList\Service\TaskService as TaskService;

$taskService = new TaskService();
echo $taskService->getPageNum();
