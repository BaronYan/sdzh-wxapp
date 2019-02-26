<?php
namespace app\common\model;

class Manager extends Base
{
    protected $pk = 'manager_id';
    /**
     * 用户登录认证
     *
     * @return void
     */
    public static function checkLogin()
    {
        $login = input('post.');
        if (!VerifyCheck($login['verify'])) {
            return result(-2, '验证码错误');
        }
        if (!$login['username'] || !$login['password']) {
            return result(-3, '用户名或密码为空');
        }
        $admin = self::getUserWithUsername($login['username']);
        if ($admin) {
            if ($admin['manager_pass'] == md5($login['password'])) {
                self::autoLogin($admin);
                return result(1, '登陆成功');
            } else {
                return result(-4, '用户名或密码错误');
            }
        } else {
            return result(-1, '用户不存在');
        }
    }
    public static function logout()
    {
        session('auth_admin', null);
    }

    private static function autoLogin($admin = array())
    {
        $_admin = array(
            'manager_id' => $admin['manager_id'],
            'ml_time' => time(),
            'ml_type' => 1,
            'ml_message' => '登录IP:' . getclientip(),
        );
        session('auth_uid', $admin['manager_id']);
        session('auth_admin', $admin);
    }
    private static function getUserWithUsername($username)
    {
        return self::where('manager_login', $username)->find();
    }
}
