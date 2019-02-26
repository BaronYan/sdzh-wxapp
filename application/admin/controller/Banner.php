<?php
namespace app\admin\controller;

use app\common\model\Banner as Ba;

class Banner extends BaseAuth
{
    public function index()
    {
        $list = Ba::get();
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function add()
    {
        return $this->_jump(Ba::add());
    }
    public function del()
    {
        return $this->_jump(Ba::del());
    }
    public function uploadimgs()
    {
        return json($this->upload('imgs'));
    }

}
