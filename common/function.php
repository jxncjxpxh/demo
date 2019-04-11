<?php

function dd($data) {
	echo '<pre>'; 
	    print_r($data);
	echo '</pre>'; 
}

function dump($data = '') {
    var_dump($data);
}

function show404()
{
    header('HTTP/1.1 404 Not Found');
    header("status: 404 Not Found");
    exit;
}

/**
 *RC4加密解密算法函数
 * @param string $pwd 秘钥
 * @param string $data 解密字符串
 * return string 二进制数
 */
function rc4 ($pwd, $data)
{
    $key[] ="";
    $box[] ="";
    $cipher ="";

    $pwd_length = strlen($pwd);
    $data_length = strlen($data);

    for ($i = 0; $i < 256; $i++)
    {
        $key[$i] = ord($pwd[$i % $pwd_length]);
        $box[$i] = $i;
    }

    for ($j = $i = 0; $i < 256; $i++)
    {
        $j = ($j + $box[$i] + $key[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $data_length; $i++)
    {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;

        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;

        $k = $box[(($box[$a] + $box[$j]) % 256)];
        $cipher .= chr(ord($data[$i]) ^ $k);
    }

    return $cipher;
}
/**
 * rc4密文转十六进制加密
 * @param string $pwd 秘钥
 * @param string $data 加密字符串
 * return string 十六进制数
 */
function getRc4Encode($pwd, $data)
{
    return bin2hex(rc4($pwd, $data));
}
/**
 * rc4解密
 * @param string $pwd 秘钥
 * @param string $data 解密字符串
 * return string
 */
function getRc4Decode($pwd, $data)
{
    return rc4($pwd, hex2bin($data));
}
/**
 * rc4 经过 base64加密
 * @param string $pwd
 * @param string $data 加密字符串
 * @return string base64;
 */
function getRc4Base64Encode($pwd,$data)
{
    return base64_encode(rc4($pwd,$data));
}
/*
 * rc4解密 经过 base64解密再rc4解密
 * @param string $pwd
 * @param string $data 密文
 * @return string;
 */
function getRc4Base64Decode($pwd,$data)
{
    return rc4($pwd,base64_decode($data));
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function get_client_ip($type = 0){
    $type      = $type ? 1 : 0;
    static $ip = null;
    if (null !== $ip) {
        return $ip[$type];
    }

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) {
            unset($arr[$pos]);
        }

        $ip = trim($arr[0]);
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}