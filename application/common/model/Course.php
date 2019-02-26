<?php
namespace app\common\model;

class Course extends Base
{
    protected $pk = 'course_id';
    public static function add()
    {
        $input = input('post.');
        if ($_FILES['imgurl']['size']) {
            $file = request()->file('imgurl');
            $info = $file->validate(['size' => 20 * 1024 * 1024, 'ext' => 'jpeg,jpg,png,gif'])->move('./uploads');
            if ($info) {
                $input['imgurl'] = $info->getSaveName();
            } else {
                return result(-1, $file->getError());
            }
        } else {
            $input['imgurl'] = '';
        }

        if (!isset($input['seriesid']) || empty($input['seriesid'])) {
            return result(-1, '请先选择课程');
        }
        if (!isset($input['course_title']) || empty($input['course_title'])) {
            return result(-2, '课时标题能为空');
        }
        if (!isset($input['course_video']) || empty($input['course_video'])) {
            return result(-3, '课时地址不能为空');
        }

        $s = Series::where('series_id', $input['seriesid'])->find();
        if ($s) {
            $temptem = time();
            $_data = array(
                'course_title' => $input['course_title'],
                'course_pics' => $input['imgurl'],
                'course_video' => $input['course_video'],
                'course_isfree' => $input['course_isfree'],
                'course_content' => $input['info'],
                'course_addtime' => $temptem,
            );
            $ret = self::insert($_data);
            if ($ret) {
                $courseid = self::where('course_addtime', $temptem)->find();
                $ss = Series::where('series_id', $input['seriesid'])->update(['series_course' => $s['series_course'] . ',' . $courseid['course_id']]);
                if ($ss) {
                    return result(1, '添加课时成功');
                } else {
                    return result(-4, '添加课时失败');
                }
            } else {
                return result(-5, '添加课时失败');
            }
        } else {
            return result(-6, '课程不存在');
        }
    }
    public static function postEdit()
    {
        # code...
    }
}
