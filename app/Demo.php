<?php

namespace app;

use lib\cache\Redis;
use lib\db\Mysql;

class Demo extends Base {

	public function __construct() {

	}

	function sis() {
        $s = Mysql::getInstance()->table('dx_users')->select();
        dump($s);
    }
	function index() {

		$p = new Mysql();
		$s = $p->table('dx_users')->select();
		dd($s);
	}

	function info() {
	    $p = new \model\Users;
	    dump($p->getInfo());
    }

    function redis() {
	    $p = Redis::getInstance();
	    if(!$p->get('sb')){
	        $p->set('sb',['a'=>2,'d'=>'主'],10);
        }
	    dump($p->get('sb',true));
    }
}