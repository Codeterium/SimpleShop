<?php

require_once('../components/DatabaseConnect.php');
require_once('../vendor/smarty/smarty/libs/Smarty.class.php');

/**
 * Класс приложения
 * @author codeterium@gmail.com
 */
class App
{
    /**
     * Массив с настройками
     *
     * @var array
     */
    public $config;

    /**
     * Объект шаблонизатора
     *
     * @var object
     */
    public $smarty;

    /**
     * $Объект подключения к БД
     *
     * @var object
     */
    public $db;

    /**
     * Конструктор класса
     *
     * @param array $config
     * @return void
     */
    public function __construct($config)
    {
        $this->config = $config;

        // Создаем подключение к БД
        $this->db = new DatabaseConnect(
            $this->config['db']['dbHost'],
            $this->config['db']['dbName'],
            $this->config['db']['dbUser'],
            $this->config['db']['dbPass']
        );

        // Создаём шаблонизатор
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir($config['smarty']['templateDir']);
        $this->smarty->setCompileDir($config['smarty']['compileDir']);
        $this->smarty->setCacheDir($config['smarty']['cacheDir']);
        $this->smarty->setConfigDir($config['smarty']['configDir']);

        if (isset($_SESSION['adminLogged'])) {
            $this->smarty->assign('adminLogged',true);
        } else {
            $this->smarty->assign('adminLogged',false);
        };

        if(! isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        };

        if(! isset($_SESSION['orders'])){
            $_SESSION['orders'] = array();
        };

        // Количество товаров в корзине
        $cartItemsCount = count($_SESSION['cart']);
        // Количество оплаченных заказов
        $ordersItemsCount = count($_SESSION['orders']);

        $this->smarty->assign('cartItemsCount',$cartItemsCount);
        $this->smarty->assign('ordersItemsCount',$ordersItemsCount);

    }

    /**
     * Loader загрузчика страниц
     *
     * @param string $controllerName
     * @param string $actionName
     * @return render|null
     */
    public function loader($controllerName, $actionName, $id)
    {
        // Формируем переменные для контроллера
        $controllerClass = $controllerName . $this->config['postfix']['controller'];
        $controllerFile = "../controllers/{$controllerClass}.php";
        $controllerFilePath = $this->config['basePath'] . "/controllers/{$controllerClass}.php";

        // Формируем переменные для экшена
        $actionClass = $actionName . $this->config['postfix']['action'];

        // если файл существует
        if (file_exists($controllerFilePath)) {
            require_once($controllerFile);
            $controller = new $controllerClass();
            if ($controller) {
                $controller->smarty = $this->smarty;
                $controller->app = $this;
                if (method_exists($controller, $actionClass)) {
                    if($id && $id>0){
                        $controller->$actionClass($id);
                    } else {
                        $controller->$actionClass();
                    }
                } else {
                    $controller->indexAction();
                }
                return null;
            }
        } else {
            echo 'Отсутствует контроллер';
        }
        exit();
    }

    /**
     * Отображение шаблона
     *
     * @param mixed $smarty
     * @param string $template
     * @return void
     */
    public function render($smarty, $template)
    {
        $templateName = $this->config['smarty']['templateDir'] . $template . $this->config['smarty']['templateExt'];
        $smarty->display($templateName);
    }
}
