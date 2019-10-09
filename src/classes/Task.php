<?php
/**
 * Created by PhpStorm.
 * User: plue
 * Date: 09.10.2019
 * Time: 20:20
 */

class Task
{
    private $statuses = ['Новое', 'Выполняется', 'Завершено', 'Отменено'];
    private $roles = [];
    private $operations = [];

    public $currentStatus = null
    private $ownerId = null;
    private $workerId = null;

    public function __construct($status = 'Новое')
    {
        $this->currentStatus = $status;
    }

    public function getStatuses()
    {
        return $this->statuses;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getNextStatus()
    {
        return $this->roles;
    }

}
