<?php

use App\classes\Task;

require_once __DIR__ . '/vendor/autoload.php';

$task = new Task();

$task->start();
$task->complete();
$status = $task->getStatus();

assert($status === Task::STATUS_COMPLETED, 'Возвращает статус завершено');

assert($task->getNextStatus(Task::ACTION_CREATE) === Task::STATUS_CREATED, 'При создании задачи возвращается корректный статус');
assert($task->getNextStatus(Task::ACTION_START) === Task::STATUS_STARTED, 'При начале выполнения задачи возвращается корректный статус');
assert($task->getNextStatus(Task::ACTION_CANCEL) === Task::STATUS_CANCELED, 'При отмене задачи возвращается корректный статус');
assert($task->getNextStatus(Task::ACTION_COMPLETE) === Task::STATUS_COMPLETED, 'При завершении задачи возвращается корректный статусП');
assert($task->getNextStatus(Task::ACTION_FAIL) === Task::STATUS_FAILED, 'При провале задачи возвращается корректный статус');
