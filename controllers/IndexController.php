<?php

require_once('../components/Helpers.php');
require_once('../models/GoodModel.php');

/**
 * IndexController дефолтный контроллер главной страницы
 * @author codeterium@gmail.com
 */
class IndexController
{
    /**
     * Главный экшен сайта
     *
     * @return void
     */
    public function indexAction()
    {
        // Создание модели
        $model = new GoodModel($this->app->db->connection);
        // Полученике всех товаров из таблицы
        $goods = $model->getAll();
        // Если товары есть, то обрабатываем и выводим
        if ($goods) {
            // Просмотр всех товаров на наличие в корзине
            foreach ($goods as $good => $key) {
               $goods[$good]['incart']=(in_array($key['id'], $_SESSION['cart'])) ? 1 : 0;
            }
        }
        // Передаем модели в обработчик шаблонов
        $this->smarty->assign('models', $goods);
        // Вывод вида
        $this->app->render($this->smarty, 'site.index');
    }
}
