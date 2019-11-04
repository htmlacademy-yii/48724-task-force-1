<?php
/**
 * Created by IntelliJ IDEA.
 * User: plue
 * Date: 05/11/2019
 * Time: 01:27
 */

namespace App\classes;


class ActionCancel extends AbstractAction
{
    const STATUS = 'Отменено';
    const ACTION = 99;

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
