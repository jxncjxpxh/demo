<?php

namespace app;

class Index {
	function index() {
		dd('abc');
		echo 'this is Index/index';
	}
	function info() {
		echo 'this a info';
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