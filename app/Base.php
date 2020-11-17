<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/11
 * Time: 14:24
 */

namespace app;

use lib\Controller;
use lib\aes\Rc4;

class Base extends Controller
{
    public $getData;
    public function initialize() {
//        dump(Rc4::decode($this->request->param('pm')));exit;
        $this->getData = Rc4::decode($this->request->param('pm'));
    }
}