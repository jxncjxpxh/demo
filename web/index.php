<?php
/*
 * 入口文件
 * author peixiuhua
 * index.php?s=app/action 访问形式
 */

if( version_compare(PHP_VERSION,'7.0') < 0 )
{
    header("Content-type: text/html; charset=utf-8");
    die('当前php版本是'.PHP_VERSION.'必须要大于等于7.0');
}

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
define('ROOT_PATH', dirname(__DIR__)); // 项目根目录
require_once __DIR__ . '/../vendor/autoload.php';

core\Start::run();