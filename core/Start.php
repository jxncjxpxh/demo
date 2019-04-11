<?php
/*
 * 初始化核心类库
 */
namespace core;
use config\Route;

class Start {
	public static function run() {
		self::parseUrl();
	}

	private static function parseUrl()
    {
        $className = '\app\Index';
        $action = 'index';

        if (!empty($_GET['s'])) {
            $urlInfoArr = explode('/', $_GET['s']);
            $controller = $urlInfoArr[0];
            $controllerName = Route::$config[$controller][0] ?? $controller;

            $requestType = Route::$config[$controller][1] ?? 'GET';
            $_SERVER['REQUEST_METHOD'] === $requestType ?: show404();
            $className = '\app\\' . ucfirst($controllerName);
            $action = $urlInfoArr[1] ?? 'index';
        }

        try {
            (new $className)->$action();
        } catch (\Error $e) {
            show404();
        }
	}


}