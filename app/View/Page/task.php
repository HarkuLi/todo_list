<?php
use Harku\TodoList\Config\TaskConfig;
?>

<!DOCTYPE html>
<html>
<head>
    <title>task list</title>
    <!-- <link rel="stylesheet" type="text/css" href="main.css" />
    <script src="main.js"></script> -->
    <?php include __DIR__."/../Partial/head.html"; ?>
</head>
<body>
    <div class="container">

        <!-- Pagination -->
        <div class="text-center">
            <?php include __DIR__."/../Partial/pagination.php"; ?>
        </div>

        <?php foreach ($taskList as $task) { ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <?= $task["title"] ?>
                </div>
                <div class="panel-body">
                    Start date: <?= $task["start_date"] ?><br>
                    Status: <?= TaskConfig::TASK_STATUS_TEXT[$task["status"]] ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>