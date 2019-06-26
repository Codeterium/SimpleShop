<?php
/**
 * Вспомогательные функции: утилиты и хелперы
 * @author codeterium@gmail.com
 */
class Helpers
{
    /**
     * Функция перенаправления
     *
     * @param mixed $url
     * @param mixed $permanent
     * @return void
     */
    public function redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit();
    }
}
