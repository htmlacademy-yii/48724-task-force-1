<?php

namespace App\classes;

use App\classes\actions\ActionCreate;
use App\classes\actions\ActionStart;
use App\classes\actions\ActionCancel;
use App\classes\actions\ActionComplete;
use App\classes\actions\ActionFail;

class Task
{

    const STATUS_CREATED = 'Новое';
    const STATUS_STARTED = 'Выполняется';
    const STATUS_COMPLETED = 'Завершено';
    const STATUS_CANCELED = 'Отменено';
    const STATUS_FAILED = 'Провалена';

    private const ACTIONS = [
        ActionCreate::class => [ActionStart::class, ActionCancel::class],
        ActionStart::class => [ActionComplete::class, ActionCancel::class, ActionFail::class],
        ActionCancel::class => null,
        ActionComplete::class => null,
        ActionFail::class => null,
    ];

    private const RELATIONS = [
        ActionCreate::class => self::STATUS_CREATED,
        ActionStart::class => self::STATUS_STARTED,
        ActionCancel::class => self::STATUS_CANCELED,
        ActionComplete::class => self::STATUS_COMPLETED,
        ActionFail::class => self::STATUS_FAILED,
    ];


    private $currentStatus;
    private $customer_id;

    function __construct($id)
    {
        $this->currentStatus = self::STATUS_CREATED;
        $this->customer_id = $id;

    }


    public function getStatus()
    {

        return $this->currentStatus;

    }

    private function setStatus($newStatus)
    {

        if (!$this->canChange($newStatus)) {

            throw new \Exception("Ошибка статуса " . $newStatus);

        }


        $this->currentStatus = $newStatus;

    }

    private function canChange($newStatus)
    {

        $nextStatuses = self::ACTIONS[$this->currentStatus];

        return (!empty($nextStatuses) && in_array($newStatus, $nextStatuses));

    }

    public function getNextStatus($actionClass)
    {
        if (isset(self::RELATIONS[$actionClass])) {

            return self::RELATIONS[$actionClass];

        }

        throw new \Exception("Неверный экшн " . $actionClass);
    }

    public function start()
    {

        $this->setStatus(self::STATUS_STARTED);
    }

    public function complete()
    {

        $this->setStatus(self::STATUS_COMPLETED);
    }

    public function cancel()
    {

        $this->setStatus(self::STATUS_CANCELED);
    }

    public function fail()
    {

        $this->setStatus(self::STATUS_FAILED);
    }

    public function getAvailibleActions($task, $initiatorId)
    {

        $availibleActions = [];

        if (ActionCreate::verify($task, $initiatorId)) {

            $availibleActions[] = ActionCreate::getName();

        }

        if (ActionStart::verify($task, $initiatorId)) {

            $availibleActions[] = ActionStart::getName();

        }

        if (ActionComplete::verify($task, $initiatorId)) {

            $availibleActions[] = ActionComplete::getName();

        }

        if (ActionCancel::verify($task, $initiatorId)) {

            $availibleActions[] = ActionCancel::getName();

        }

        if (ActionFail::verify($task, $initiatorId)) {

            $availibleActions[] = ActionFail::getName();

        }

        return $availibleActions;
    }

    public function getCustomerId()
    {

        return $this->customer_id;

    }

}


