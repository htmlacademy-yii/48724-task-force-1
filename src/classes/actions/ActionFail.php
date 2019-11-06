<?php

namespace App\classes\actions;
use App\classes\Task;


class ActionFail extends AbstractAction
{
    private const CODE = 'Провалена';

    static public function getName() {

        return self::class;

    }

    static public function getCode()
    {
        return self::CODE;
    }

    static public function verify(Task $task, int $initiatorId) : bool
    {

        if ($task -> getStatus() != 'Выполняетcя') {

            return false;

        }

        return $task -> getCustomerId() === $initiatorId;

    }
}
