<?php

// 应用公共文件

// require 'function/check.php';
/**
 * 格式化返回结果
 */
if (!function_exists('result')) {
    function result($status = 1, $message = '', $data = '', $url = '')
    {
        return array('status' => $status, 'message' => $message, 'data' => $data);
    }
}

/**
 * 生成验证码
 */
if (!function_exists('Verify')) {
    function Verify()
    {
        $Captcha = new \think\captcha\Captcha();
        $Captcha->length = 4;
        return $Captcha->entry();
    }
}

/**
 * 核对验证码
 */
if (!function_exists('VerifyCheck')) {
    function VerifyCheck($code)
    {
        $Captcha = new \think\captcha\Captcha();
        return $Captcha->check($code);
    }
}
/**
 * 获取客户端IP
 */
if (!function_exists('getclientip')) {
    function getclientip()
    {
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            return $_SERVER['HTTP_X_REAL_IP'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return '';
        }
    }
}
