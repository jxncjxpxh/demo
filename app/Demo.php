<?php

namespace app;

use lib\db\Mysql;

class Demo extends Base {

	public function __construct() {

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
	    $p = new \lib\cache\Redis();
	    if(!$p->get('sb')){
	        $p->set('sb',['a'=>2,'d'=>'主'],10);
        }
	    dump($p->get('sb',true));
    }
}