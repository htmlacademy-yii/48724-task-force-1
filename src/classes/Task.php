<?php
/**
 * Created by PhpStorm.
 * User: plue
 * Date: 09.10.2019
 * Time: 20:20
 */

class Task
{

    const STATUS_NEW = 'Новое';
    const STATUS_IN_WORK = 'Выполняется';
    const STATUS_COMPLETED = 'Завершено';
    const STATUS_CANCEL = 'Отменено';

    protected $currentStatus;

    function __construct()
    {

        $this->begin();

    }

    private $map = [
        self::STATUS_NEW => [self::STATUS_IN_WORK, self::STATUS_CANCEL],
        self::STATUS_IN_WORK => [self::STATUS_COMPLETED, self::STATUS_CANCEL],
        self::STATUS_COMPLETED => null,
        self::STATUS_CANCEL => null,
    ];


    public function getStatus()
    {

        return $this->currentStatus;

    }

    public function canChange($newStatus)
    {

        $current = $this->getStatus();

        // при создании, когда еще нет статуса
        if (!$current && $newStatus === self::STATUS_NEW) {
            return true;
        }

        $nextStatuses = $this->map[$current];

        return (!empty($nextStatuses) && in_array($newStatus, $nextStatuses));

    }


    public function setStatus($newStatus)
    {

        if ($this->canChange($newStatus)) {

            $this->currentStatus = $newStatus;
            return true;
        }

        echo 'Ошибка';
        return false;

    }

    public function begin()
    {

        $this->setStatus(self::STATUS_NEW);

    }

    public function cancel()
    {

        $this->setStatus(self::STATUS_CANCEL);

    }

    public function start()
    {

        $this->setStatus(self::STATUS_IN_WORK);

    }

    public function complete()
    {

        $this->setStatus(self::STATUS_COMPLETED);

    }

}
