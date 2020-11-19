<?php

namespace app;

use lib\Controller;

class Index extends Controller {
	function index() {
		dd('abc');
		echo 'this is Index/index';
	}
	function info() {
		echo 'this a info';
        $this->response->sendConent(['age'=>20,'name'=>'lqbz']);

	}
	function test() {
	    $data = \lib\Config::get('redis');
	    dd($data);
    }
    function getCity() {
	    echo 1;
	    $p = new \lib\net\IpLocation();
	    $s = $p->getlocation();
	    dump($s);
    }
}