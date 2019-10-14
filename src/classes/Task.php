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
    const STATUS_CANCELED = 'Отменено';
    const STATUS_FAILED = 'Провалена';

    const ACTION_BEGIN = 1;
    const ACTION_START = 2;
    const ACTION_END = 3;
    const ACTION_FAIL = 98;
    const ACTION_CANCEL = 99;


    protected $currentStatus;

    function __construct()
    {

        $this->setStatus(self::STATUS_NEW);

    }

    private $relations = [
        self::ACTION_BEGIN => self::STATUS_NEW,
        self::ACTION_START => self::STATUS_IN_WORK,
        self::ACTION_END => self::STATUS_COMPLETED,
        self::ACTION_FAIL => self::STATUS_FAILED,
        self::ACTION_CANCEL => self::STATUS_CANCELED,
    ];

    private $map = [
        self::STATUS_NEW => [self::STATUS_IN_WORK, self::STATUS_CANCELED],
        self::STATUS_IN_WORK => [self::STATUS_COMPLETED, self::STATUS_CANCELED, self::STATUS_FAILED],
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

        $current = $this->getStatus();

        // при создании, когда еще нет статуса
        if (!$current && $newStatus === self::STATUS_NEW) {
            return true;
        }

        $nextStatuses = $this->map[$current];

        return (!empty($nextStatuses) && in_array($newStatus, $nextStatuses));

    }


    private function setStatus($newStatus)
    {

        if ($this->canChange($newStatus)) {

            $this->currentStatus = $newStatus;
            return true;
        }

        echo 'Ошибка';
        return false;

    }

    public function getNextStatus($action)
    {
        if (isset($this->relations[$action])) {

            return $this->relations[$action];

        }

        throw new \Exception("Неверный код действия");
        return false;
    }

}

$x = new Task();
// echo $x->getStatus();
// var_dump($x->getNextStatus($x::ACTION_START) == $x::STATUS_IN_WORK);

var_dump(assert($x->getNextStatus($x::ACTION_CANCELsdf) == $x::STATUS_CANCELED, 'cancel action'));
