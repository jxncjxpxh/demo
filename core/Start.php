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
            $info = self::routerMapper($controller);
            $controllerName = $info[0];
            $requestType = $info[1] ?? 'GET';
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

	private static function routerMapper(string $controller):array {
	    $routeArr = Route::$config;

        if(array_key_exists($controller, $routeArr)) {
            return $routeArr[$controller];
        }

        foreach (Route::$config as $p) {
            if(in_array($controller, $p)) {
                show404();
            }
        }

        return (array) $controller;
    }


}