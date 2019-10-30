<?php


namespace App\models;

/**
 * Модель таблицы Tasks, экземпляр модели является строкой в БД, свойства соответствуют столбцам в БД
 */
class Task
{
    private $id;
    private $dt_create;
    private $dt_end;
    private $dt_deadline;
    private $name;
    private $description;
    private $category_id;
    private $price;
    private $city_id;
    private $location_id;
    private $customer_id;
    private $executer_id;

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
    public function validate()
    {

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
     * Ищет в БД таблице tasks запись с переданным id
     * @param $id
     */
    public function getById($id)
    {

    }

    /**
     * Ищет в БД таблице cities запись с переданным $city_id
     * @param $city_id
     */
    public function getCityId($city_id)
    {

    }

}
