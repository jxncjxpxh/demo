<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/11
 * Time: 14:59
 */

namespace model;

use lib\db\Mysql;

class Users extends Mysql
{
    public $tableName = 'dx_users';

    function getInfo() {
//        return $this->query();
//        return $this->findOne();
//        return $this->insert(['updated_at'=>'2019-04-11 16:03:46','created_at'=>'2019-04-11 16:03:46'],true);
        return $this->update(['email'=>'22@qq.com']);
    }

}