<?php

namespace lib;

class View {
	protected $files; // 模板文件
	protected $vars = []; // 模板变量

   /*
    * 设置模板
    * @params $file string 
    */
	public function setTemplete( $file ) {
		$this->files = ROOT_PATH . '/view/' .  $file . '.html';
	}

	/*
	 * 分配变量
	 * @params $name string
	 * @params $values string
	 */
	public function setVars($name, $values) {
		$this->vars[$name] = $values;
	}

	public function display() {
		extract($this->vars); // 把变量数组变量转换成key值变量 分配到模板中
		include $this->files;
		die();
	}
}