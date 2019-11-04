<?php

namespace App\classes;


class ActionFail extends AbstractAction
{
    const STATUS = 'Провалена';
    const ACTION = 98;

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
