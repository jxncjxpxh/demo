<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/12
 * Time: 9:58
 * 助手函数
 */

use lib\View;

if(!function_exists('view')) {
    function view() {
        return (new View());
    }
}