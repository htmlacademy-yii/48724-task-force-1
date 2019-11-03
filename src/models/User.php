<?php


namespace App\models;

/**
 * Модель таблицы Users, экземпляр модели является строкой в БД, свойства соответствуют столбцам в БД
 */
class User
{
    private $id;
    private $dt_create;
    private $dt_birthday;
    private $email;
    private $password;
    private $name;
    private $avatar;
    private $addres;
    private $info;
    private $skype;
    private $messenger;
    private $city_id;
    private $view_count;
    private $show_for_customers;

    /**
     * Получает данные из формы и заполняет св-ва нашей таблицы для сохранения
     * @param $data
     */
    public function loadFromForm($data)
    {

    }

    /**
     * Проверка св-в текущего обьекта на валидность
     */
    public function validate(){

    }

    /**
     * Сохранение значение св-в в бд
     */
    public function save()
    {
        if ($this->id) {
            // UPDATE WHERE id = $this-> id
        }

    }

    /**
     * Ищет в БД таблице users запись с переданным id
     * @param $id
     */
    public function getById($id)
    {

    }

}
