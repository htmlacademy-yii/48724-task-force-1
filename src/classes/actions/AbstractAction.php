<?php

namespace App\classes\actions;



use App\classes\Task;

abstract class AbstractAction
{

    abstract static public function getName();

    abstract static public function getCode();

    abstract static public function verify(Task $task, int $initiatorId) : bool;

}


