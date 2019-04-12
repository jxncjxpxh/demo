<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/12
 * Time: 16:49
 * 请求类
 */

namespace lib;

use lib\traits\Singleton;

class Request
{
    use Singleton;

    public $originString;

    function __construct()
    {
        $this->originString = file_get_contents('php://input') ?: $_SERVER['QUERY_STRING']; //  获取原始数据流
    }

    function param($args = '') {
        parse_str($this->originString,$originArray);

        if($args == '') {
            return $originArray;
        } else {
            return $originArray[$args] ?? '';
        }
    }

}