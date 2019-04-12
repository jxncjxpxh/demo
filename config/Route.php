<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/11
 * Time: 11:18
 * 路由配置文件
 * 关于接口访问规范
 * 如果有做路由转换 则必须按照路由地址key访问 直接访问对应的控制器 会404
 * 如果不在此路由配置里面 这可以直接调用接口名
 * 注意默认访问url是get方式，如有限制严格按照路由方式请求否则404
 */

namespace config;

class Route {
    public static $config = [
      'abc'=>['index'],
    ];
}