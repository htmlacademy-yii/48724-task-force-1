<?php
/**
 * Created by IntelliJ IDEA.
 * User: plue
 * Date: 05/11/2019
 * Time: 01:27
 */

namespace App\classes\actions;
use App\classes\Task;


class ActionCancel extends AbstractAction
{
    private const CODE = 'Отменено';

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
