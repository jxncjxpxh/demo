<?php

namespace lib\db;

class Mysql {
	protected $conn = null;
	private $prefix;
	protected $tableName;

	public function __construct($config) {
		if( $this->conn == null ) {
			try{
				$dns = $config['dbtype'] . ":host=" . $config['host'] . ";dbname=" . $config['dbname'];
				$options = [
				    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$config['charset'],
				    \PDO::ATTR_PERSISTENT => true,
				]; 
				$this->conn = new \PDO($dns, $config['user'], $config['pwd'], $options);
				$this->prefix = $config['prefix'];
			}catch(\PDOException $e) {
				die('Error:'. $e->getMessage());
			}
		}
	}

	public static function table($tableName) {
		$this->tableName = $tableName;
		return $this;
	}

	public function name($tableName) {
		$this->tableName = $this->prefix . $tableName;
		return $this;
	}

	public function select($where) {

	}

	public function update() {

	}

	public function insert() {

	}

	public function delete() {

	}

	public function exec() {

	}

	public function query($fields, $where) {
		$sql = 'SELECT ' . $fields . ' FROM ' .$this->tableName. ' WHERE '. $where;
		$obj = $this->conn->query($sql);
		if(is_object($obj)) {
			return $obj->fetchAll(\PDO::FETCH_ASSOC);
		} 
		return false;
	}

}