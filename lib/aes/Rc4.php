<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/12
 * Time: 18:38
 */

namespace lib\aes;


class Rc4
{
    private static $key = 'abcfg';

    /**
     *RC4加密解密算法函数
     * @param string $pwd 秘钥
     * @param string $data 解密字符串
     * @return string 二进制数
     */
    public static function aes($pwd, $data) {
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
     *RC4加密解密算法函数
     * @param string $data 解密字符串
     * @param string $type 数据格式(16进制，base64)
     * @return string
     */
    static function encode($data,$type = 'base64')
    {
        if($type == '16') {
            return bin2hex(self::aes(self::$key, $data));
        }else if($type == 'base64') {
            return base64_encode(self::aes(self::$key,$data));
        }
    }
    /**
     *RC4解密解密算法函数
     * @param string $data 解密字符串
     * @param string $type 数据格式(16进制，base64)
     * @return string
     */
    static function decode($data,$type = 'base64')
    {
        if($type == '16') {
            return self::aes(self::$key, hex2bin($data));
        }else if($type == 'base64') {
            return self::aes(self::$key,base64_decode($data));
        }
    }
}