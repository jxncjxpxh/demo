<?php

namespace app;

use lib\View;

class Article {
	public $view;

	public function __construct() {
		$this->view = new View;
	}

	public function show() {
		$this->view->setTemplete( 'show' );
		$this->view->setVars('title', 'sb');
		$this->view->display();
	}
}