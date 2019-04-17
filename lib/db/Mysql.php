<?php

namespace lib\db;

use lib\traits\Singleton;
use lib\Config;

class Mysql {
    use Singleton;
	protected $conn = null;
	private $prefix;
	protected $tableName;

	public function __construct() {
        $config = Config::get('mysql');
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
				die('Error:MYSQL connect fail =='. $e->getMessage());
			}catch (\Error $e) {
			    die('PDO extension not exists ==' . $e->getMessage());
            }
		}
	}

	public function table($tableName) {
		$this->tableName = $tableName;
		return $this;
	}

	public function name($tableName) {
		$this->tableName = $this->prefix . $tableName;
		return $this;
	}

	public function select($fields = '*', $where = '1=1') {
        $sql = 'SELECT ' . $fields . ' FROM ' .$this->tableName. ' WHERE '. $where;
        return $this->queryAll($sql);
	}

	public function findOne($fields = '*', $where = '1=1') {
        $sql = 'SELECT ' . $fields . ' FROM ' .$this->tableName. ' WHERE '. $where . ' LIMIT 0,1';
        $data = $this->queryOne($sql);
        if($data) {
            return $data;
        }
        return false;
    }

	public function update($data, $where = '1=1') {
	    if(!is_string($where)) {
	        die('非法操作');
        }

        $updateData = [];

        if(is_string($data)) {
            $updateString = $data;
        } else {
            foreach ($data as $k => $v) {
                if(is_int($v)) {
                    $updateData[] = "`$k`=".$v;
                } else {
                    $updateData[] = "`$k`='".$v."'";
                }
            }
            $updateString = implode(',', $updateData);
        }

        $sql = 'UPDATE ' . $this->tableName . ' SET ' . $updateString . ' WHERE ' . $where;

        return $this->exec($sql);
	}

	public function insert($data,$isId = false) {
        if(!is_array($data)) {
            die('非法操作');
        } else {
            $keys = [];
            $vals = [];
            foreach ($data as $k => $v) {
                $keys[] = $k;
                if(is_int($v)){
                    $vals[] = $v;
                }else {
                    $vals[] = "'". $v ."'";
                }
            }
            $key_string = implode(',', $keys);
            $val_string = implode(',', $vals);
            $sql = 'INSERT INTO ' . $this->tableName . '(' . $key_string . ')' . ' VALUES ' . '(' . $val_string . ')';
            if($isId) {
                $this->exec($sql);
                return $this->conn->lastInsertId();
            } else {
                return $this->exec($sql);
            }
        }
	}

	public function delete($where) {
        if(!is_string($where)) {
            die('非法操作数据');
        } else {
            $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $where;
            return $this->exec($sql);
        }
	}

	/**
	 * 执行SQL
     * @param string $sql
     * return mixd
	 */
	public function exec($sql = '') {
	    if(!$sql) {
	        return null;
        }

        $r = $this->conn->exec($sql);
	    return $r;
	}
	/**
	 * 原生态sql查询
     * @param string $sql
     * return mixd
	 */
	public function queryAll($sql='') {
        if(!$sql) {
            return null;
        }
		$obj = $this->conn->query($sql);
		if(is_object($obj)) {
			$r = $obj->fetchAll(\PDO::FETCH_ASSOC);
			return $r;
		}
		return false;
	}
    /**
     * 原生态sql查询
     * @param string $sql
     * return mixd
     */
    public function queryOne($sql='') {
        if(!$sql) {
            return null;
        }
        $obj = $this->conn->query($sql);
        if(is_object($obj)) {
            $r = $obj->fetch(\PDO::FETCH_ASSOC);
            return $r;
        }
        return false;
    }

    public function clear() {
        $this->conn = null;
    }

    public function runSql($sql = '') {
        $query = $this->conn->query($sql);
        $this->conn = null;

        if(!$query) {
            return false;
        }
        return true;
    }
}