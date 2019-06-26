<?php

/**
 * Модель товаров
 * @author codeterium@gmail.com
 */
class GoodModel
{
    /**
     * Название таблицы
     *
     * @var string
     */
    public $tableName = 'goods';

    /**
     * Объект connection
     *
     * @var object
     */
    public $connection;

    /**
     * $id
     *
     * @var integer
     */
    public $id = 0;
    /**
     * $title
     *
     * @var string
     */
    public $title;
    /**
     * $price
     *
     * @var float
     */
    public $price = 0;
    /**
     * $status
     *
     * @var integer
     */
    public $status = 0;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Получение всех товаров из таблтиы
     *
     * @return array|null
     */
    public function getAll()
    {
        // Объекты из таблицы
        $models = null;
        // Запрос к базе
        $query = "
            SELECT
            *
            FROM
            `{$this->tableName}`;
        ";
        // Выполнение запроса
        $result = $this->connection->query($query);
        // При успешном завершении выборка строк из результирующего набора в ассоциативный массив
        if ($result) {
            $models = mysqli_fetch_all($result, MYSQLI_ASSOC);
        };
        // Ассоциативный массив
        return $models;
    }

    /**
     * Получение товаров из таблицы, которые есть в корзине
     *
     * @param array $ids
     * @return array|null
     */
    public function getAllByIds($ids)
    {
        // Объекты из таблицы
        $models = null;
        // Перевод массива Ids в строку
        $idsString = (is_array($ids)) ? implode(',', $ids) : $ids;
        // Запрос к базе
        $query = "
            SELECT
            *
            FROM
            `{$this->tableName}`
            WHERE
            `id` IN({$idsString});
        ";
        // Выполнение запроса
        $result = $this->connection->query($query);
        // При успешном завершении выборка строк из результирующего набора в ассоциативный массив
        if ($result) {
            $models = mysqli_fetch_all($result, MYSQLI_ASSOC);
        };
        // Ассоциативный массив
        return $models;
    }

    /**
     * Получение одной записи по индексу
     *
     * @param integer $id
     * @return array|null
     */
    public function getOneByID($id)
    {
        // Объекты из таблицы
        $models = null;
        // Запрос к базе
        $query = "
            SELECT
            *
            FROM
            `{$this->tableName}`
            WHERE
            `id`={$id};
        ";
        // Выполнение запроса
        $result = $this->connection->query($query);
        // При успешном завершении выборка строк из результирующего набора в ассоциативный массив
        if ($result) {
            $models = mysqli_fetch_assoc($result);
        };
        // Ассоциативный массив
        return $models;
    }

    /**
     * Запись изменений в базу
     *
     * @return boolean
     */
    public function saveModel()
    {
        // Если нет названия то выход
        if (!$this->title) {
            return false;
        }

        // Проверка значений
        $this->price = $this->price ? $this->price : 0;
        $this->status = $this->status ? $this->status : 0;

        // Запрс - новый/изменеие
        if ($this->id == 0) {
            $query = "
                INSERT INTO goods
                (
                    `title`,
                    `price`,
                    `status`
                )
                VALUES
                (
                    '{$this->title}',
                    {$this->price},
                    {$this->status}
                );
            ";
        } else {
            $query = "
                UPDATE `{$this->tableName}`
                SET
                `title` = '{$this->title}',
                `price` = {$this->price},
                `status` = {$this->status}
                WHERE
                `id` = {$this->id}
                ;
            ";
        }

        $result = $this->connection->query($query);
        return $result;
    }

    /**
     * Новая запись
     *
     * @return array
     */
    public function newModel()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'status' => $this->status
        ];
    }

    /**
     * Удаление записи
     *
     * @param mixed $id
     * @return void
     */
    public function deleteModel($id)
    {
        $query = "
            DELETE FROM `{$this->tableName}`
            WHERE
            `id` = {$id}
            ;"
        ;

        $result = $this->connection->query($query);
        return $result;
    }
}
