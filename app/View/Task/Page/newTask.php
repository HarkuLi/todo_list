<!DOCTYPE html>
<html>
<head>
    <title>new task</title>
    <?php include __DIR__."/../../Shared/Partial/head.html"; ?>
</head>
<body>
    <div class="container">
        <form action="/task/create" method="post">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <input type="text" class="form-control" placeholder="Title" name="title">
                </div>
                <div class="panel-body">
                    <button type="submit" class="btn btn-info btn-sm">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>