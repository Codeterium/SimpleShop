<?php

/**
 * Class DatabaseConnect Простой класс подключения к базе данных
 * @author codeterium@gmail.com
 */
class DatabaseConnect
{

    /**
     * $connection
     *
     * @var object
     */
    public $connection;

    /**
     * DatabaseConnect constructor.
     *
     * @param string $host
     * @param string $database
     * @param string $username
     * @param string $password
     */
    public function __construct($host, $database, $username, $password)
    {
        $this->connection = new mysqli($host, $username, $password, $database);

        // проверяем соединение
        if ($this->connection->connect_error) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Текст ошибки error: " . $this->connection->connect_error;
            exit();
        }

        // изменяем текущую базу данных на $database
        $databaseset = mysqli_select_db($this->connection, $database);
        if (!$databaseset) {
            echo "Ошибка: Ошибка соединения с " . $database;
            exit();
        }

        // установка UTF-8
        $charset = $this->connection->set_charset("utf8");
        if (!$charset) {
            echo "Ошибка: Не выполнена загрузка набора символов UTF-8.";
            exit();
        }
    }

    /**
     * DatabaseConnect destructor
     *
     */
    public function __destruct()
    {
        if (!$this->connection->connect_errno) {
            $this->connection->Close();
        }
        $this->connection = null;
    }

    /**
     * connection
     *
     * @return connection
     */
    public function connection()
    {
        return $this->connection;
    }
}
