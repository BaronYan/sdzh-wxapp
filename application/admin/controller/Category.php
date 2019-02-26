<?php
namespace app\admin\controller;

use app\common\model\ScCategory;

class Category extends BaseAuth
{
    /**
     * 分类列表
     */
    public function index()
    {
        $list = ScCategory::getCate();
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 添加分类
     */
    public function add()
    {
        return json(ScCategory::add());
    }
    /**
     * 删除分类
     */
    public function del()
    {
        return json(ScCategory::del());
    }
    /**
     * 编辑分类
     */
    public function edit()
    {
        return json(ScCategory::edit());
    }
}
