<?php

require_once('../components/Helpers.php');
require_once('../models/GoodModel.php');

/**
 * Контроллер административной панели
 * @author codeterium@gmail.com
 */
class AdminController
{
    /**
     * Объект шаблонизатора smarty
     *
     * @var object
     */
    public $smarty;

    /**
     * Объект приложения
     *
     * @var object
     */
    public $app;

    /**
     * Дефолтный экшен
     *
     * @return void
     */
    public function indexAction()
    {
        // Валидация пользователя
        if (!isset($_SESSION['adminLogged'])) {
            Helpers::redirect('/admin/login/', false);
        }
        // Создание модели
        $model = new GoodModel($this->app->db->connection);
        // Полученике всех товаров из таблицы
        $models = $model->getAll();
        // Передаем модели в обработчик шаблонов
        $this->smarty->assign('models', $models);
        // Вывод вида
        $this->app->render($this->smarty, 'admin.index');
    }

    /**
     * Добавление новой записи
     *
     * @return void
     */
    public function newAction()
    {
        if (!isset($_SESSION['adminLogged'])) {
            Helpers::redirect('/admin/login/', false);
        }
        // Создание модели
        $goodModel = new GoodModel($this->app->db->connection);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $goodModel->id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : '';
            $goodModel->title = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : '';
            $goodModel->price = (isset($_POST['price']) && !empty($_POST['price'])) ? $_POST['price'] : '';
            $goodModel->status = (isset($_POST['status'])) ? ($_POST['status'] == 1) ? 1 : 0 : '';
            $result = $goodModel->saveModel();

            if ($result) {
                Helpers::redirect('/admin/index/', false);
            }
        }

        $model = $goodModel->newModel();
        $this->smarty->assign('model', $model);
        $this->app->render($this->smarty, 'admin.edit');
    }

    /**
     * Редактирование записи
     *
     * @param integer $id
     * @return void
     */
    public function editAction($id)
    {
        if (!isset($_SESSION['adminLogged'])) {
            Helpers::redirect('/admin/login/', false);
        }
        // Создание модели
        $goodModel = new GoodModel($this->app->db->connection);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $goodModel->id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : '';
            $goodModel->title = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : '';
            $goodModel->price = (isset($_POST['price']) && !empty($_POST['price'])) ? $_POST['price'] : '';
            $goodModel->status = (isset($_POST['status'])) ? ($_POST['status'] == 1) ? 1 : 0 : '';
            $result = $goodModel->saveModel();

            if ($result) {
                Helpers::redirect('/admin/index/', false);
            }
            $id = $goodModel->id;
        }

        $model = $goodModel->getOneByID($id);
        if ($model) {
            $this->smarty->assign('model', $model);
            $this->app->render($this->smarty, 'admin.edit');
        } else {
            Helpers::redirect('/admin/index/', false);
        }
    }


    /**
     * Удаление записи
     *
     * @param integer $id
     * @return void
     */
    public function deleteAction($id)
    {
        if (!isset($_SESSION['adminLogged'])) {
            Helpers::redirect('/admin/login/', false);
        }
        // Создание модели
        $goodModel = new GoodModel($this->app->db->connection);
        if ($id && $id >= 0) {
            $goodModel->deleteModel($id);
        }
        Helpers::redirect('/admin/index/', false);
    }

    /**
     * Валидация данных
     *
     * @return void
     */
    public function loginAction()
    {
        if (isset($_SESSION['adminLogged'])) {
            Helpers::redirect('/admin/index/', false);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userName = (isset($_POST['userName']) && !empty($_POST['userName'])) ? $_POST['userName'] : '';
            $userPass = (isset($_POST['userPass']) && !empty($_POST['userPass'])) ? $_POST['userPass'] : '';
            if ($userName && $userPass) {
                if (($userName == 'admin') && ($userPass == 'admin')) {
                    $_SESSION['adminLogged'] =  true;
                    Helpers::redirect('/admin/index/', false);
                }
            }
        }

        $this->app->render($this->smarty, 'admin.login');
    }

    /**
     * Выход из админки
     *
     * @return void
     */
    public function logoutAction()
    {
        // удаление тригера из сессии
        unset($_SESSION['adminLogged']);
        // редирект на главнй экшен
        Helpers::redirect('/admin/index/', false);
    }
}
