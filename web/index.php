<?php
/*
 * 入口文件
 * author peixiuhua
 * index.php?s=app/action 访问形式
 */

define('ROOT_PATH', dirname(__DIR__)); // 项目根目录
require_once __DIR__ . '/../vendor/autoload.php';

core\Start::run();