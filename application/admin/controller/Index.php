<?php
namespace app\admin\controller;

use app\common\controller\BaseAdmin;
use app\common\model\Manager;

class Index extends BaseAdmin
{
    public function index()
    {
        return $this->fetch();
    }
    /**
     * 登录页面
     */
    public function login()
    {
        if ($this->authUser && $this->authUid) {
            $this->redirect($this->defaultPath);
        } else {
            $this->assign('loginTitle', '欢迎登录舍德教育管理后台');
            return $this->fetch();
        }
    }
    public function checkLogin()
    {
        $result = Manager::checkLogin();
        $result['url'] = $this->defaultPath;
        return json($result);
    }
    public function logout()
    {
        Manager::logout();
        $this->redirect($this->defaultPath);
    }
    public function getVerify()
    {
        return Verify();
    }

}
