<?php

namespace App\classes;

class Task
{

    const STATUS_CREATED = 'Новое';
    const STATUS_STARTED = 'Выполняется';
    const STATUS_COMPLETED = 'Завершено';
    const STATUS_CANCELED = 'Отменено';
    const STATUS_FAILED = 'Провалена';

    const ACTION_CREATE = 1;
    const ACTION_START = 2;
    const ACTION_COMPLETE = 3;
    const ACTION_FAIL = 98;
    const ACTION_CANCEL = 99;


    private $currentStatus;

    function __construct()
    {
        $this->currentStatus = self::STATUS_CREATED;

    }

    private const RELATIONS = [
        self::ACTION_CREATE => self::STATUS_CREATED,
        self::ACTION_START => self::STATUS_STARTED,
        self::ACTION_COMPLETE => self::STATUS_COMPLETED,
        self::ACTION_FAIL => self::STATUS_FAILED,
        self::ACTION_CANCEL => self::STATUS_CANCELED,
    ];

    private const MAP = [
        self::STATUS_CREATED => [self::STATUS_STARTED, self::STATUS_CANCELED],
        self::STATUS_STARTED => [self::STATUS_COMPLETED, self::STATUS_CANCELED, self::STATUS_FAILED],
        self::STATUS_FAILED => null,
        self::STATUS_COMPLETED => null,
        self::STATUS_CANCELED => null,
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
        if (isset(self::RELATIONS[$action])) {

            return self::RELATIONS[$action];

        }

        throw new \Exception("Неверный код действия " . $action);
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

}


