<?php
namespace app\common\model;

/**
 * 学员类
 */
class Student extends Base
{
    protected $pk = 'student_id';
    /**
     * 用户登录验证
     */
    public function checkLogin($loginSrc = 0)
    {
        $loginName = input("post.loginName");
        $loginPwd = input("post.loginPwd");
        $code = input("post.verifyCode");
        $rememberPwd = input("post.rememberPwd", 1);
        if (!VerifyCheck($code) && strpos(WSTConf("CONF.captcha_model"), "4") >= 0) {
            return WSTReturn('验证码错误!');
        }
    }
    public static function add($data = array())
    {
        if (isset($data['student_openid']) && !empty($data['student_openid'])) {
            $has = self::where('student_openid', $data['student_openid'])->find();
            if ($has) {
                return result(-1, '学生信息已经存在');
            }
            $ret = self::create($data);
            if ($ret) {
                return result(1, $ret);
            } else {
                return result(-1, '学生信息入库失败');
            }
        } else {
            return result(-1, '学生信息入库失败');
        }
    }
    public static function add2()
    {
        $input = input('post.');
        $openid = $input['openid'];
        if ($openid) {
            $has = self::where('student_openid', $openid)->find();
            if ($has) {
                $ret = self::where('student_openid', $openid)->update(['student_wxmeta' => json_encode($input)]);
                if ($ret) {
                    return result(1, $ret);
                } else {
                    return result(-1, '学生信息入库失败add2');
                }
            } else {
                return result(-2, 'openid不存在');
            }
        } else {
            return result(-1, 'openid为空');
        }
    }
    public static function get()
    {
        $list = self::order('student_addtime desc')->select();
        foreach ($list as $key => $value) {
            if (!empty($value['student_wxmeta'])) {
                $list[$key]['wxmeta'] = json_decode($value['student_wxmeta'], true);
            }
        }
        return $list;
    }
    public static function getForOpenid($openid = '')
    {
        return self::where('student_openid', $openid)->find();
    }
}
