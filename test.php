<?php

use App\classes\Task;
use App\classes\actions\ActionCreate;
use App\classes\actions\ActionStart;
use App\classes\actions\ActionCancel;
use App\classes\actions\ActionComplete;
use App\classes\actions\ActionFail;


require_once __DIR__ . '/vendor/autoload.php';

$task = new Task(1);

$task->start();
$task->complete();
$status = $task->getStatus();
assert($status === ActionComplete::getName(), 'Возвращает статус завершено');



//
//assert($task->getNextStatus(ActionCreate) === ActionCreate::STATUS, 'При создании задачи возвращается корректный статус');
//assert($task->getNextStatus(ActionStart) === ActionStart::STATUS, 'При начале выполнения задачи возвращается корректный статус');
//assert($task->getNextStatus(ActionCancel) === ActionCancel::STATUS, 'При отмене задачи возвращается корректный статус');
//assert($task->getNextStatus(ActionComplete) === Task::STATUS, 'При завершении задачи возвращается корректный статусП');
//assert($task->getNextStatus(ActionFail) === ActionFail::STATUS, 'При провале задачи возвращается корректный статус');
