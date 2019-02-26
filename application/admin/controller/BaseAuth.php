<?php
namespace app\admin\controller;

use app\common\controller\BaseAdmin;

class BaseAuth extends BaseAdmin
{
    
    protected function initialize()
    {
        parent::initialize();
        if ($this->authUser && $this->authUid) {
            $this->assign('username', $this->authUser['manager_login']);
        } else {
            session('auth_uid', null);
            session('auth_admin', null);
            $this->redirect($this->loginPath);
        }
    }
}
