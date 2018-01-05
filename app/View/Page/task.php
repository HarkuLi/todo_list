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

        <!-- function row -->
        <div class="clearfix">
            <a href="/task/new" class="btn btn-info btn-sm pull-right">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        </div>

        <!-- Pagination -->
        <div class="text-center">
            <?php include __DIR__."/../Partial/pagination.php"; ?>
        </div>

        <!-- task list -->
        <?php
        foreach ($taskList as $task) {
            if ($task["status"] === TaskConfig::TASK_FINISH) {
                echo "<div class=\"panel panel-success\">";
            } else {
                echo "<div class=\"panel panel-info\">";
            }
        ?>
            <div class="panel-heading clearfix">
                <span class="id hidden"><?= $task["id"] ?></span>
                <span class="pull-left"><?= $task["title"] ?></span>
                <span class="pull-right"><?= $task["start_date"] ?></span>
            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button type="button" class="btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-ok"></span>
                </button>
                <button type="button" class="btn btn-danger btn-sm pull-right">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </div>
        <?php
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>