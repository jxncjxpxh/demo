<?php

namespace lib;

class Controller {
    public $request; // 请求类实例
    public $response; // 响应类实例

    function __construct()
    {
        $this->response = Response::getInstance();
        $this->request = Request::getInstance();
        $this->initialize();
    }

    protected function initialize() {

    }
}