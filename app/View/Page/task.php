<?php
use Harku\TodoList\Config\TaskConfig;
?>

<!DOCTYPE html>
<html>
<head>
    <title>task list</title>
    <!-- <link rel="stylesheet" type="text/css" href="main.css" /> -->
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
            if ($task->getStatus() === TaskConfig::TASK_FINISH) {
                echo "<div class=\"panel panel-success\">";
            } else {
                echo "<div class=\"panel panel-info\">";
            }
        ?>
            <div class="panel-heading clearfix">
                <span class="id hidden"><?= $task->getId() ?></span>
                <span class="pull-left"><?= $task->getTitle() ?></span>
                <span class="pull-right">
                    <?php
                    echo $task->getStartDate();
                    if ($task->getStatus() === TaskConfig::TASK_FINISH) {
                        echo " ~ ".$task->getEndDate();
                    }
                    ?>
                </span>
            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-info btn-sm task_edit" title="edit">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <?php if ($task->getStatus() === TaskConfig::TASK_NOT_FINISH) { ?>
                    <button type="button" class="btn btn-info btn-sm task_finish" title="finish">
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>
                <?php } else { ?>
                    <button type="button" class="btn btn-info btn-sm task_unfinish" title="unfinish">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                <?php } ?>
                <button type="button" class="btn btn-danger btn-sm pull-right task_remove" title="delete">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </div>
        <?php
            echo "</div>";
        }
        ?>
    </div>

    <script src="/js/task.js"></script>
</body>
</html>