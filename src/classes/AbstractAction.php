<?php

namespace App\classes;



abstract class AbstractAction
{

    abstract static public function getStatus();

    abstract static public function getActionId();

    abstract static public function canChange();

}


