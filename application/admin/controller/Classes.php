<?php
namespace app\admin\controller;

use app\common\model\Classes as CL;
use app\common\model\Series;
use app\common\model\Student;
use think\facade\Request;

class Classes extends BaseAuth
{
    // 课程首页
    public function index()
    {
        // 课程列表
        $serlist = Series::get();
        $this->assign('serlist', $serlist);
        // 学员列表
        $stulist = Student::get();
        $this->assign('stulist', $stulist);
        // 班级列表
        $list = CL::getall();
        $this->assign('list', $list);
        return $this->fetch();
    }
    // 添加课程
    public function add()
    {
        if (Request::isPost()) {
            return $this->_jump(CL::add());
        } else {
            return $this->fetch();
        }
    }
    // 删除课程
    public function del()
    {
        return $this->_jump(Ba::del());
    }

    // 上传图片
    public function uploadimgs()
    {
        return json($this->upload('imgs'));
    }

    // 添加学员
    public function addstu()
    {
        return json(CL::addstu());
    }
    // 添加课程
    public function addser()
    {
        return json(CL::addser());
    }

}
