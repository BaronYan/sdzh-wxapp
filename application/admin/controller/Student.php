<?php
namespace app\admin\controller;

use app\common\model\Student as Stu;

class Student extends BaseAuth
{
    public function index()
    {
        $list = Stu::get();
        $this->assign('list', $list);
        return $this->fetch();
    }
}
