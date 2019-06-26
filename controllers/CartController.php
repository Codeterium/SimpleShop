<?php

require_once('../components/Helpers.php');
require_once('../models/GoodModel.php');

/**
 * CartController контроллер работы с корзиной
 * @author codeterium@gmail.com
 */
class CartController
{

    /**
     * Вывод всех товаров в корзине
     *
     * @return void
     */
    public function indexAction()
    {
        // Получение товаров из корзины
        $sessionIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        // Создаем модель
        $model = new GoodModel($this->app->db->connection);
        // Получение товаров из таблицы, которые есть в корзине
        $goods = $model->getAllByIds($sessionIds);
        // Передаем модели в обработчик шаблонов
        $this->smarty->assign('models', $goods);
        // Выводим вид
        $this->app->render($this->smarty, 'site.cart');
    }

    /**
     * Добавление товара в корзину
     *
     * @param integer $id
     * @return json
     */
    public function addAction($id)
    {
        if (!$id) return false;
        $resultData = [];
        if (isset($_SESSION['cart']) && array_search($id, $_SESSION['cart']) === false) {
            $_SESSION['cart'][] = $id;
            $resultData['count'] = count($_SESSION['cart']);
            $resultData['result'] = 1;
        } else {
            $resultData['result'] = 0;
        };
        echo json_encode($resultData);
    }

    /**
     * Удаление товара из корзины
     *
     * @param integer $id
     * @return json
     */
    public function deleteAction($id)
    {
        if (!$id) return false;
        $resultData = [];
        $key = array_search($id, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
            $resultData['count'] = count($_SESSION['cart']);
            $resultData['result'] = 1;
        } else {
            $resultData['result'] = 0;
        };
        echo json_encode($resultData);
    }

    /**
     * Удаление товара из корзины и редирект на корзину
     *
     * @param integer $id
     * @return void
     */
    public function deleteitemAction($id)
    {
        if (!$id) return false;

        $key = array_search($id, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
        };
        Helpers::redirect('/cart/', false);
    }

    /**
     * Оформление заказа
     *
     * @return void
     */
    public function orderAction()
    {
        $totalPrice = 0;
        $totalCount = 0;
        $sessionIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        // Создаем модель
        $model = new GoodModel($this->app->db->connection);
        // Получение товаров из таблицы, которые есть в корзине
        $goods = $model->getAllByIds($sessionIds);

        if ($goods) {
            foreach ($goods as $good) {
                $totalPrice += $good['price'];
                $totalCount++;
            }
        }

        // Передаем модели в обработчик шаблонов
        $this->smarty->assign('models', $goods);
        $this->smarty->assign('totalPrice', $totalPrice);
        $this->smarty->assign('totalCount', $totalCount);
        // Выводим вид
        $this->app->render($this->smarty, 'site.order');
    }

    /**
     * Оплата заказа
     *
     * @return void
     */
    public function payAction()
    {

        $url = 'https://ya.ru';
        // поработаем с CURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10); // разрешаем только 10 редиректов за раз во избежание бесконечного цикла
        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код
        $new_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);

        if ($http_code == 200) {

            $_SESSION['orders'][] = $_SESSION['cart'];
            unset($_SESSION['cart']);
            $resultData = [];
            $resultData['result'] = 1;
            $resultData['count'] = 0;
        } else {
            $resultData['result'] = 1;
        }
        echo json_encode($resultData);
    }
}
