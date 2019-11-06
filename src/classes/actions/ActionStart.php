<?php

namespace App\classes\actions;
use App\classes\Task;


class ActionStart extends AbstractAction
{
    private const CODE = 'Выполняется';

    static public function getName() {

        return self::class;

    }

    static public function getCode()
    {
        return self::CODE;
    }

    static public function verify(Task $task, int $initiatorId) : bool
    {

        return $task -> getCustomerId() === $initiatorId;

    }
}
