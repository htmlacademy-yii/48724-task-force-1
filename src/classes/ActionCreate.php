<?php
/**
 * Created by IntelliJ IDEA.
 * User: plue
 * Date: 05/11/2019
 * Time: 01:26
 */

namespace App\classes;


class ActionCreate extends AbstractAction
{
    const STATUS = 'Создана';
    const ACTION = 1;

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
