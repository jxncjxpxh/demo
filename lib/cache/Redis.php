<?php

namespace lib\cache;

class Redis {
    public $redis = null;

	public function __construct() {
        $config = include ROOT_PATH . '/config/Redis.php';

        if($this->redis == null) {
            try {
                $this->redis = new \Redis();
                $this->redis->connect($config['host'], $config['port']);
                if($config['password']) {
                    $this->redis->auth($config['password']);
                }
                $this->redis->select(1); // 选择redis数据库
            } catch (\RedisException $e) {
                die('redis connect fail=='.$e->getMessage());
            } catch (\Error $e) {
                die('redis extension not exists==' . $e->getMessage() );
            }

            return $this->redis;
        }
	}

	function set($key, $value, $expire = 0) {
	    if(is_array($value)) {
            $value = json_encode($value,320);
        }

        $this->redis->set($key,$value);

        if($expire > 0) {
            $this->redis->expire($key, $expire);
        }
    }

    function get($key, $isArray = false) {
	    $data = $this->redis->get($key);

	    if($isArray) {
	        $data = json_decode($this->redis->get($key),true);
        }
	    return $data;
    }

    public function rPush($queue, $value)
    {
        return $this->redis->rPush($queue, $value);
    }

    public function lPop($queue)
    {
        $value = $this->redis->lPop($queue);
        return $value;
    }
}