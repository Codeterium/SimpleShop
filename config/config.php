<?php
/**
 * Конфигурационный файл
 * @author codeterium@gmail.com
 */

$config = [
    'id' => 'app',
    'name' => 'Simple PHP Shop',
    'basePath' => dirname(__DIR__),
    'db' => [
        'dbHost' => 'localhost',
        'dbName' => 'simple_db',
        'dbUser' => 'root',
        'dbPass' => '',
    ],
    'postfix'=>[
        'controller' => 'Controller',
        'action' => 'Action'
    ],
    'smarty'=>[
        'templateExt'   =>'.tpl',
        'templateDir'   =>'../views/default/',
        'compileDir'    =>'../tmp/smarty/compiled',
        'cacheDir'      =>'../tmp/smarty/cache',
        'configDir'     =>'../config/smarty',

    ]
];