<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/11
 * Time: 18:12
 */

namespace lib\traits;


trait Singleton
{
    public static $instance;

    public static function getInstance() {
        if(empty(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}