<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/12
 * Time: 16:08
 * 配置类
 */

namespace lib;

class Config
{
    public static function get($name) {
        $filePaht = ROOT_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $name . '.php';

        if($name == '' || !is_file($filePaht)) {
            show404();
        }

        $config = include $filePaht;

        return $config;
    }

}