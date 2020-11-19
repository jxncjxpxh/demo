<?php
/*
 * 初始化核心类库
 */
namespace core;

use route\Route;
use lib\Hook;

class Start {
	public static function run() {
	    self::import(); // 注册标签位
		self::parseUrl();
	}

	private static function parseUrl()
    {
//        $className = '\app\Index';
//        $action = 'index';

        if (!empty($_GET['s'])) {
            $urlInfoArr = explode('/', strip_tags($_GET['s']));
            $controller = strtolower( $urlInfoArr[0] );
            $info = self::routerMapper($controller);
            $controllerName = $info[0];
            $requestType = $info[1] ?? 'GET';
            $_SERVER['REQUEST_METHOD'] === $requestType ?: show404();
            $className = '\app\\' . ucfirst($controllerName);
            $action = $urlInfoArr[1] ?? 'index';
        }

        if(!isset($className)) {
            show404();
        }

        try {
            Hook::listen('app_init');
            (new $className)->$action();
            Hook::listen('app_end');
        } catch (\Error $e) {
//            show404();
            die('Eroor:' . $e->getMessage());
        }
	}

	private static function routerMapper(string $controller):array {
	    $routeArr = Route::$config;

        if(array_key_exists($controller, $routeArr)) {
            return $routeArr[$controller];
        }

        foreach ($routeArr as $p) {
            if(in_array($controller, $p)) {
                show404();
            }
        }

        return (array) $controller;
    }

    private static function import() {
        // 加载行为扩展文件
        if (is_file(ROOT_PATH . '/config/tags.php')) {
            $tags = include ROOT_PATH . '/config/tags.php';
            if (is_array($tags)) {
                Hook::import($tags);
            }
        }
    }


}