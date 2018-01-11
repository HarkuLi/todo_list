<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Harku\TodoList\Service\TaskService;

$taskService = new TaskService();

$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

// write todo list into the worksheet
$rowArray = ["title", "start date", "end date", "status"];
$worksheet->fromArray($rowArray, null, "A1", true);
$row = 2;

$totalPage = $taskService->getPageNum();
for ($page=1; $page<=$totalPage; ++$page) {
    $taskList = $taskService->getPage($page);
    foreach ($taskList as $task) {
        $rowArray = [
            $task->getTitle(),
            $task->getStartDate(),
            $task->getEndDate(),
            $task->getStatus()
        ];
        $worksheet->fromArray($rowArray, null, "A$row", true);
        ++$row;
    }
}

// convert the spreadsheet to a file variable
$writer = IOFactory::createWriter($spreadsheet, "Ods");
ob_start();
$writer->save("php://output");
$exportFile = ob_get_clean();

// response
header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
header("Content-Disposition: attachment; filename=todo_list_export.ods");
echo $exportFile;
