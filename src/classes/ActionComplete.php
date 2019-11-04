<?php

namespace App\classes;


class ActionComplete extends AbstractAction
{
    const STATUS = 'Завершено';
    const ACTION = 3;

    static public function getStatus()
    {
        return STATUS;
    }

    static public function getActionId()
    {
        return ACTION;
    }

    static public function canChange()
    {
        // TODO: Implement canChange() method.
    }
}
