<?php
use Harku\TodoList\Config\TaskConfig;
?>

<!DOCTYPE html>
<html>
<head>
    <title>task list</title>
    <!-- <link rel="stylesheet" type="text/css" href="main.css" /> -->
    <?php include __DIR__."/../../Shared/Partial/head.html"; ?>
</head>
<body>
    <div class="container">

        <!-- tool bar -->
        <div class="well row">
            <div class="col-sm-8">
                <!-- new button -->
                <a href="/task/new" class="btn btn-info btn-sm" title="new">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                <!-- export button -->
                <a href="/task/export" class="btn btn-info btn-sm" title="export">
                    <span class="glyphicon glyphicon-export"></span>
                </a>
            </div>

            <!-- search -->
            <form method="get" action="/task" class="col-sm-4">
                <input type="text" class="hidden" name="status" value="<?= $status ?>">
                <div class="input-group">
                    <input type="text"
                        class="form-control"
                        name="title"
                        value="<?= $title ?>"
                        placeholder="task keyword">
                    <div class="input-group-btn">
                        <button class="btn btn-info" type="submit" title="search">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- status tabs -->
        <ul class="nav nav-tabs">
            <?php
            foreach (TaskConfig::TASK_STATUS_TEXT as $idx => $text) {
                if ($idx === $status) {
                    echo "<li class=\"active\">";
                } else {
                    echo "<li>";
                }
                echo "<a href=\"/task?status=$idx\">$text</a>";
                echo "</li>";
            }
            ?>
        </ul>

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