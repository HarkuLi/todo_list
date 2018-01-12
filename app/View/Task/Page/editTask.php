<!DOCTYPE html>
<html>
<head>
    <title>edit task</title>
    <?php include __DIR__."/../../Shared/Partial/head.html"; ?>
</head>
<body>
    <div class="container">
        <form action="/task/update_content" method="post">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row flex_vertical_center">
                        <div class="col-sm-10">
                            <input type="text"
                                class="hidden"
                                name="id"
                                value="<?= $task->getId() ?>">
                            <input type="text"
                                class="form-control"
                                name="title"
                                value="<?= $task->getTitle() ?>">
                        </div>
                        <div class="col-sm-2">
                            <span class="text-center"><?= $task->getStartDate() ?></span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <button type="submit" class="btn btn-info btn-sm">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>