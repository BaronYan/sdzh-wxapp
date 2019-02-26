<?php
namespace app\admin\controller;

class Main extends BaseAuth
{
    public function index()
    {
        $this->assign('pageTitle', '舍德教育管理后台');
        return $this->fetch();
    }
}
