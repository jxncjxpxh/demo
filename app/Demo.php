<?php

namespace app;

use demo\Test;
use lib\db\Mysql;

class Demo {
	public $dbconfig = [];

	public function __construct() {
		$this->dbconfig = include ROOT_PATH . '/config/mysql.php';
	}
	function index() {

		$p = new Mysql($this->dbconfig);
		$s = $p->name('config')->query('*','id>1');
		dd($s);
	}
}