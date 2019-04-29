# easy mvc api framework
it is quick api
version : v1.0
author : JACKSON
date：2019/04/28

目录形式
   
    project 应用部署目录
    ├─app 控制器目录    
    ├─behavior 行为定义
    ├─common 公共函数库
    │   ├─function.php
    ├─config 配置目录
    │   ├─mysql.php mysql配置
    │   ├─redis.php redis配置
    │   ├─tags.php 行为定义/钩子
    ├─core 
    │   ├─Start.php 引导文件
    ├─lib 框架核心目录
    │   ├─aes
    │   │  ├─Rc4.php Rc4 加解密算法
    │   ├─cache
    │   │  ├─Redis.php Redis处理类
    │   ├─db
    │   │  ├─Mysql.php MYSQL处理基类
    │   ├─net
    │   │  ├─  IpLocation.php 区域获取类
    │   ├─traits
    │   │  ├─Singletion 单例
    │   ├─Config.php 获取配置类
    │   ├─Controller.php 控制器基类
    │   ├─helper.php 助手函数
    │   ├─Hook.php 行为类
    │   ├─Model.php 模型基类
    │   ├─Request.php 请求类
    │   ├─Response.php 响应类
    │   ├─View.php 视图类
    ├─model 模型类目录
    ├─resource 资源目录
    │   ├─area
    │      ├─qqwry20190220.dat 区域数据信息
    │   ├─sqlfile sql文件目录        
    ├─route 路由定义
    │   ├─Route.php
    ├─vendor composer扩展目录
    ├─view 视图目录
    ├─web 对外访问目录
    ├─.gitignore git忽略配置
    ├─composer.json composer配置文件
    ├─LICENSE Apache License
    ├─README.md
**访问形式**
/controller/action

controller 对应根目录下app目录下的控制器
action 对应根目录下app目录下的控制器方法

默认控制器为Index 方法为index

**路由配置**
/route/Route.php
class Route {
    public static $config = [
      'abc'=>['index'],
      'abefg'=>['demo','POST'],
    ];
}
$config 静态数组变量健名是访问规则健值里面的数组第一个元素是控制器，第二元素是请求的方法（默认是get）
       
