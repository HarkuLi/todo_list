<!DOCTYPE html>
<html>
<head>
    <title>task list</title>
    <!-- <link rel="stylesheet" type="text/css" href="main.css" />
    <script src="main.js"></script> -->
    <?php
        include __DIR__."/../Partial/head.html";
    ?>
</head>
<body>
    <div class="container">
        <?php foreach ($taskList as $task) { ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <?= $task["title"] ?>
                </div>
                <div class="panel-body">
                    <?= $task["start_date"] ?>
                </div>
                <div class="panel-footer">
                    <?= $task["status"] ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>