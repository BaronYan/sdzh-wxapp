<?php
namespace app\admin\controller;

use app\common\model\Posts as PO;
use think\facade\Request;

class Posts extends BaseAuth
{

    public function aboutme()
    {
        $about = PO::getAboutUS();
        $this->assign('about', $about);
        if (Request::isPost()) {
            return $this->_jump(PO::editAboutUS());
        } else {
            return $this->fetch();
        }
    }

}
