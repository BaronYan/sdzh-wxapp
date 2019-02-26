<?php
namespace app\admin\controller;

use app\common\model\ScCategory;
use app\common\model\Series as SE;
use think\facade\Request;

class Series extends BaseAuth
{

    /**
     * 创建课程分类
     */
    public function add()
    {
        if (Request::isPost()) {
            return $this->_jump(SE::add());
        } else {
            $cate = ScCategory::getCate();
            $this->assign('cate', $cate);
            return $this->fetch();
        }
    }
    /**
     * 修改课程分类
     */
    public function editSeriesCate()
    {
        if ($this->requirst->isPost()) {
            $scc = new ScCategory();
            $ret = $scc->editSCC();
            return $this->_jump($ret);
        } else {
            return $this->fetch();
        }
    }
    /**
     * 删除课程分类
     */
    public function delSeriesCate()
    {
        $scc = new ScCategory();
        $ret = $scc->delSCC();
        return $this->_jump($ret);
    }

    /**
     * 课程列表
     */
    function list() {
        $list = SE::get();
        $cate = ScCategory::getCate();
        foreach ($list as $key => $value) {
            $list[$key]['series_addtime'] = date("Y-m-d H:i:s", $value['series_addtime']);
            foreach ($cate as $key2 => $value2) {
                if ($value['series_category'] == $value2['scc_id']) {
                    $list[$key]['series_category'] = $value2['scc_title'];
                }
            }
        }
        $this->assign('list', $list);
        $this->assign('cate', $cate);
        return $this->fetch();
    }

    /**
     * 编辑系列课程
     */
    public function apiEdit()
    {
        $sid = input('sid');
        if (!empty($sid)) {
            if ($this->request->isPost()) {
                $ret = SE::postEditSerie();
                return json($ret);
            } else {
                $serie = SE::where('series_id', $sid)->find();
                $cate = ScCategory::getCate();
                return json(array('serie' => $serie, 'cate' => $cate));
            }
        }
    }
}
