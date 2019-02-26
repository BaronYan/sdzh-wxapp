<?php
namespace app\common\model;

class Classes extends Base
{
    protected $pk = 'class_id';

    /**
     * 创建班级
     */
    public static function add()
    {
        $input = input('post.');
        if (isset($input['classesTitle']) && !empty($input['classesTitle'])) {
            $_data = array();
            $_data['class_name'] = $input['classesTitle'];
            $_data['class_content'] = $input['classInfo'];
            $_data['class_starttime'] = $input['starttime'];
            $_data['class_endtime'] = $input['endtime'];
            $ret = self::insert($_data);
            if ($ret) {
                return result(1, '添加班级成功', $ret);
            } else {
                return result(-1, '添加班级失败');
            }
        } else {
            return result(-1, '添加班级失败,班级名称不能为空');
        }
    }
    /**
     * 获取班级列表
     */
    public static function getall()
    {
        $list = self::order('class_id desc')->select();
        return $list;
    }
    public static function addstu()
    {
        $input = input('post.');
        if (isset($input['classid']) && !empty($input['classid'])) {
            $ids = explode(',', trim($input['ids']));
            $temp = array();
            foreach ($ids as $value) {
                if (!empty($value) && !in_array($value, $temp)) {
                    array_push($temp, $value);
                }
            }
            if (count($temp) > 0) {
                $ids = implode(',', $temp);
            } else {
                $ids = '';
            }
            $ret = self::where('class_id', $input['classid'])->update(['class_studentids' => $ids]);
            if ($ret) {
                return result(1, '操作成功');
            } else {
                return result(-1, '操作失败');
            }
        } else {
            return result(-2, '操作失败');
        }
    }
    public static function addser()
    {
        $input = input('post.');
        if (isset($input['classid']) && !empty($input['classid'])) {
            $ids = explode(',', trim($input['ids']));
            $temp = array();
            foreach ($ids as $value) {
                if (!empty($value) && !in_array($value, $temp)) {
                    array_push($temp, $value);
                }
            }
            if (count($temp) > 0) {
                $ids = implode(',', $temp);
            } else {
                $ids = '';
            }
            $ret = self::where('class_id', $input['classid'])->update(['class_seriesids' => $ids]);
            if ($ret) {
                return result(1, '操作成功');
            } else {
                return result(-1, '操作失败');
            }
        } else {
            return result(-2, '操作失败');
        }
    }
    /**
     * 获取班级课程
     */
    public static function getmyseries($cid, $uid)
    {
        $class = self::select();
        $myclass = array();
        foreach ($class as $key => $value) {
            $seriesids = explode(',', $value['class_seriesids']);
            $studentids = explode(',', $value['class_studentids']);
            if (in_array($cid, $seriesids) && in_array($uid, $studentids)) {
                array_push($myclass, $class[$key]);
            }
        }
        return $myclass;
    }

}
