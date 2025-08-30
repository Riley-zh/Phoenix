<?php
require_once 'config/config.php';
require_once 'core/Router.php';
require_once 'core/Database.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';

// 启动会话
session_start();

// 创建路由器实例
$router = new Router();

// 定义路由
$router->add('/', 'HomeController@index');
$router->add('/home', 'HomeController@index');
$router->add('/users', 'UserController@index');
$router->add('/users/create', 'UserController@create');
$router->add('/users/store', 'UserController@store');
$router->add('/users/edit/{id}', 'UserController@edit');
$router->add('/users/update/{id}', 'UserController@update');
$router->add('/users/delete/{id}', 'UserController@delete');
$router->add('/api/users', 'ApiController@users');

// 获取当前URL路径
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 移除项目根目录路径（如果不在根目录运行）
$basePath = dirname($_SERVER['SCRIPT_NAME']);
if ($basePath !== '/') {
    $url = str_replace($basePath, '', $url);
}

// 处理路由
$router->dispatch($url);