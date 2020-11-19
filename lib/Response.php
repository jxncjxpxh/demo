<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/12
 * Time: 16:48
 */

namespace lib;

use lib\aes\Rc4;

class Response
{
    public static $instance;
    private static $status = [
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Moved Temporarily ',  // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',
        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    ];

    private static $contentType = [
        'json'    =>  'text/json',
        'xml'    =>  'text/xml',
        'plain' =>  'text/plain',
        'html' =>  'text/html',
    ];

    /**
     * 发送HTTP状态
     * @param integer $code 状态码
     * @return object
     */
    function sendHttpStatus($code) {
        if(isset(self::$status[$code])) {
            header('HTTP/1.1 '.$code.' '.self::$status[$code]);
            // 确保FastCGI模式下正常
            header('Status:'.$code.' '.self::$status[$code]);
        }

        return $this;
    }
    /**
     * 发送数据至客户端
     * @access public
     * @param string|array $data
     * @param string $contentType
     * @return string
     */
    public function sendConent($data, $contentType = 'json',$isEncry = true,$code = 200) : string {
        $this->sendHttpStatus($code);
        $cType = self::$contentType[$contentType] ?: 'text/json';
        header('Content-Type:' . $cType . ';charset=utf-8');
        if(is_array($data)) {
            $data = json_encode($data, 320);
        }

        if($isEncry) {
            $data = Rc4::encode($data);
            dump($data);exit;
        }
        return $data;
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}