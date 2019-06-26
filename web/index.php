<?php
/**
 * Index file
 * @author codeterium@gmail.com
 */
session_start();

require_once('../config/config.php');
require_once('../components/App.php');

// Получаем имена контроллера и экшена
$controller = (isset($_GET['controller'])) ? ucfirst($_GET['controller']) : 'Index';
$action = (isset($_GET['action'])) ? $_GET['action'] : 'index';
$id = (isset($_GET['id'])) ? $_GET['id'] : '0';

// Формируем и запускаем контроллер и экшен
$app = new App($config);
$app->loader($controller, $action, $id);