<?php


namespace App\models;


class File
{
    private $id;
    private $path;
    private $user_id;
    private $task_id;

    /**
     * Получает файл из формы и заполняет св-ва нашей таблицы для сохранения
     * @param $file
     */
    public function loadFIle($file)
    {

    }

    /**
     * Валидация загруженных файлов
     */
    public function validate(){

    }

    /**
     * Сохранение фалов на сервер и значений свойств в БД
     */
    public function save()
    {

    }

    /**
     * Ищет в БД таблице task_files запись с переданным $task_id
     * @param $task_id
     */
    public function getTaskFile($task_id)
    {

    }

    /**
     * Ищет в БД таблице user_files запись с переданным $user_id
     * @param $user_id
     */
    public function getUserFile($user_id)
    {

    }


}
