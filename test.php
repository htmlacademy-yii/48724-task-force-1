<?php

use App\classes\AvailableActions;
use App\classes\ActionCreate;
use App\classes\ActionStart;
use App\classes\ActionCancel;
use App\classes\ActionComplete;
use App\classes\ActionFail;


require_once __DIR__ . '/vendor/autoload.php';

$task = new AvailableActions();

$task->start();
$task->complete();
$status = $task->getStatus();
assert($status === ActionComplete::STATUS, 'Возвращает статус завершено');

assert($task->getNextStatus(ActionCreate) === ActionCreate::STATUS, 'При создании задачи возвращается корректный статус');
assert($task->getNextStatus(ActionStart) === ActionStart::STATUS, 'При начале выполнения задачи возвращается корректный статус');
assert($task->getNextStatus(ActionCancel) === ActionCancel::STATUS, 'При отмене задачи возвращается корректный статус');
assert($task->getNextStatus(ActionComplete) === AvailableActions::STATUS, 'При завершении задачи возвращается корректный статусП');
assert($task->getNextStatus(ActionFail) === ActionFail::STATUS, 'При провале задачи возвращается корректный статус');
