<?php

namespace App\classes;

class AvailableActions
{

    private $currentStatus;

    function __construct()
    {
        $this->currentStatus = ActionCreate::STATUS;

    }

    private const MAP = [
        ActionCreate::STATUS => [ActionStart::STATUS , ActionCancel::STATUS],
        ActionStart::STATUS => [ActionComplete::STATUS, ActionCancel::STATUS, ActionFail::STATUS],
        ActionFail::STATUS => null,
        ActionComplete::STATUS => null,
        ActionCancel::STATUS => null,
    ];


    public function getStatus()
    {
        return $this->currentStatus;
    }

    private function canChange($newStatus)
    {
        $nextStatuses = self::MAP[$this->currentStatus];

        return (!empty($nextStatuses) && in_array($newStatus, $nextStatuses));
    }


    private function setStatus($newStatus)
    {

        if (!$this->canChange($newStatus)) {

            throw new \Exception("Ошибка статуса " . $newStatus);
        }


        $this->currentStatus = $newStatus;

    }

    public function getNextStatus($action)
    {
        if ($action::ACTION !== null ) {

            return $action::STATUS;
        }

        throw new \Exception("Неверный код действия " . $action::ACTION);
    }

    public function start()
    {
        $this->setStatus(ActionStart::STATUS);
    }


    public function complete()
    {
        $this->setStatus(ActionComplete::STATUS);
    }


    public function cancel()
    {
        $this->setStatus(ActionCancel::STATUS);
    }


    public function fail()
    {
        $this->setStatus(ActionFail::STATUS);
    }

}


