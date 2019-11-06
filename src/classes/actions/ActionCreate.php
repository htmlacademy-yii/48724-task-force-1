<?php

namespace App\classes\actions;
use App\classes\Task;


class ActionCreate extends AbstractAction
{
    private const CODE = 'Создана';

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
