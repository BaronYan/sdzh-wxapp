<?php
namespace app\admin\controller;

use app\common\model\Course as CO;
use app\common\model\Series as SE;

class Course extends BaseAuth
{
    /**
     * 添加课时
     */
    public function add()
    {
        $list = SE::get();
        // foreach ($list as $key => $value) {
        //     $list[$key]['series_addtime'] = date("Y-m-d H:i:s", $value['series_addtime']);
        // }
        $series_id = input('serieslist');
        if ($series_id) {
            $this->assign('seriesid', $series_id);
        } else {
            $this->assign('seriesid', '');
        }
        if ($series_id) {
            $series = SE::where('series_id', $series_id)->find();
            $seriescourse = CO::where('course_id', 'in', $series['series_course'])->select();
            $this->assign('seriescourse', $seriescourse);
            $this->assign('series', $series);
        } else {
            $this->assign('series', '');
        }
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function addCourse()
    {
        return $this->_jump(CO::add(), '/admin/keshi/add');
    }

    /**
     * 编辑课时
     */
    public function apiEdit()
    {
        $cid = input('cid');
        if (!empty($sid)) {
            if ($this->request->isPost()) {
                $ret = CO::postEdit();
                return json($ret);
            } else {
                $serie = CO::where('course_id', $cid)->find();
                return json(array('serie' => $serie));
            }
        }
    }

}
