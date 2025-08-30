<?php
// 数据库配置
define('DB_HOST', 'localhost');
define('DB_NAME', 'php_project');
define('DB_USER', 'root');
define('DB_PASS', '');

// 应用配置
define('APP_NAME', 'PHP MVC 项目');
define('APP_URL', 'http://localhost');
define('APP_DEBUG', true);

// 错误报告
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// 时区设置
date_default_timezone_set('Asia/Shanghai');
