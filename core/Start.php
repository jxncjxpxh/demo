<?php
/*
 * 初始化核心类库
 */
namespace core;

class Start {
	public static function run() {
		self::parseUrl();
	}

	private static function parseUrl() {
		$className = '\app\Index';
		$action = 'index';

		if(!empty($_GET['s'])) {
			$urlInfoArr = explode('/',$_GET['s']);
			$className = '\app\\' . ucfirst($urlInfoArr[0]);
			$action = $urlInfoArr[1];
		}

		(new $className)->$action();
	}


}