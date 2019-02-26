<?php
namespace app\common\model;

// 因为赶工期，没有做校验
class Series extends Base
{
    protected $pk = 'series_id'; //scc_id

    /**
     * 创建课程分类
     */
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
        } elseif (!empty($input['imglink'])) {
            $input['imgurl'] = $input['imglink'];
        } else {
            return result(-1, '主图不能为空');
        }
        if (!isset($input['title']) || empty($input['title'])) {
            return result(-1, '标题不能为空');
        }
        $_data = array(
            'series_title' => $input['title'],
            'series_sub' => $input['subtile'],
            'series_category' => $input['cate'],
            'series_pic' => $input['imgurl'],
            'series_price' => $input['price'],
            'series_content' => $input['info'],
            'series_status' => $input['status'],
            'series_addtime' => time(),
            'series_teacher' => $input['teacher'],
        );
        $result = self::insert($_data);
        if ($result) {
            return result(1, '创建课程成功', $result);
        } else {
            return result(-1, '创建课程失败');
        }
    }
    public function edit()
    {
        $input = input('post.');
        if ($this->getSCC_by_id($input['sccid'])) {
            $_data = array();
            if (isset($_data['scc_title']) && !empty($_data['scc_title'])) {
                $_data['scc_title'] = $input['scctitle'];
            }
            if (isset($_data['scc_pid']) && !empty($_data['scc_pid'])) {
                $_data['scc_pid'] = $input['scc_pid'];
            }
            if (isset($_data['scc_sort']) && !empty($_data['scc_sort'])) {
                $_data['scc_sort'] = $input['scc_sort'];
            }
            $result = $this->data($_data)->save();
            if ($result) {
                return result(1, '编辑课程分类成功', $result);
            } else {
                return result(-1, '编辑课程分类失败');
            }
        } else {
            return result(-1, '非法操作');
        }
    }
    public function del()
    {
        $sccid = input('get.sccid');
        if ($this->getSCC_by_id($sccid)) {

            $result = $this->data($_data)->save();
            if ($result) {
                return result(1, '删除课程分类成功', $result);
            } else {
                return result(-1, '删除课程分类失败');
            }
        } else {
            return result(-1, '非法操作');
        }
    }
    public static function get()
    {
        $input = input('post.');
        if (empty($input)) {
            $list = self::order('series_addtime desc')->select();
            return $list;
        } else {
            $where = array();
            if (!empty($input['cate'])) {
                // $where['series_category'] = $input['cate'];
                $where[] = ['series_category', '=', $input['cate']];
            }
            if (!empty($input['status'])) {
                // $where['series_status'] = $input['status'];
                $where[] = ['series_status', '=', $input['status']];
            }
            if (!empty($input['title'])) {
                $where[] = ['series_title', 'like', '%' . $input['title'] . '%'];
            }
            if (!empty($input['author'])) {
                $where[] = ['series_teacher', 'like', '%' . $input['author'] . '%'];
            }
            if ($where) {
                return self::where($where)->order('series_addtime desc')->select();
            } else {
                return self::order('series_addtime desc')->select();
            }
        }

    }
    private function getById($id = '')
    {
        if (empty($id)) {
            return false;
        }
        $ret = $this->where('series_id', $id)->find();
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }
    public static function getseriesById()
    {
        $input = input('post.');
        $id = input('id');
        $openid = input('uopenid');
        $ihasauth = 0;
        // 判断openid是否存在，以及openid是否在
        if (!empty($id)) {
            if (!empty($openid)) {
                $stu = Student::where('student_openid', $openid)->find();
                if ($stu) {
                    $myclass = Classes::getmyseries($id, $stu['student_id']);
                    if ($myclass) {
                        $ihasauth = 1;
                    }
                }
            }
            $series = self::where('series_id', $id)->find();
            if (!empty($series['series_pic'])) {
                $series['series_pic'] = 'https://vip.gzsdzh.com/uploads/' . $series['series_pic'];
            }
            if ($series) {
                $cour = Course::where('course_id', 'in', $series['series_course'])->order('course_addtime desc')->select();
                foreach ($cour as $key => $value) {
                    if (!empty($value['course_pics'])) {
                        $cour[$key]['course_pics'] = 'https://vip.gzsdzh.com/uploads/' . $value['course_pics'];
                    }
                }
                $series['course'] = $cour;
                $series['ihasauth'] = $ihasauth;
                return result(1, $series);
            } else {
                return result(-2, '操作数据有误');
            }
        } else {
            return result(-1, '操作数据有误');
        }
    }

    public static function getmyseries()
    {
        $input = input('post.');
        if (isset($input['couriesid']) && !empty($input['couriesid']) && isset($input['uopenid']) && !empty($input['uopenid'])) {
            $u = Student::getForOpenid($input['uopenid']);
            if ($u) {
                $ret = Classes::getmyseries($input['couriesid'], $u['student_id']);
                if ($ret) {

                    $myseries = self::where('series_id', $input['couriesid'])->find();
                    if ($myseries) {
                        $mycour = Course::where('course_id', 'in', $myseries['series_course'])
                            ->order('course_sort asc,course_addtime desc')->select();
                        return result(1, $mycour);
                    } else {
                        return result(-5, '对不起，你还未被授权，请联系管理员加入班级');
                    }

                } else {
                    return result(-4, '对不起，你还未被授权，请联系管理员加入班级');
                }
            } else {
                return result(-3, '用户不存在');
            }
            if ($ret) {
                return result(1, $ret);
            } else {
                return result(-2, '对不起，你还未被授权，请联系管理员加入班级');
            }
        } else {
            return result(-1, '对不起，你需要授权小程序获取你的头像信息');
        }
    }
    public static function getmycourse()
    {
        $input = input('post.');
        if (isset($input['couriesid']) && !empty($input['couriesid']) && isset($input['uopenid']) && !empty($input['uopenid'])) {
            $u = Student::getForOpenid($input['uopenid']);
            if ($u) {
                $ret = Classes::getmyseries($input['couriesid'], $u['student_id']);
                return result(1, $ret);
            } else {
                return result(-3, '用户不存在');
            }
            if ($ret) {
                return result(1, $ret);
            } else {
                return result(-2, '对不起，你还未被授权，请联系管理员加入班级');
            }
        } else {
            return result(-1, '对不起，你需要授权小程序获取你的头像信息');
        }
    }
    /**
     * 根据ID获取单个系列
     */
    public static function getSerieByid()
    {
        $sid = input('sid');
        $has = self::where('series_id', $sid)->find();
        if ($has) {
            return result(1, $has);
        } else {
            return result(-1, '请求的课程不存在');
        }
    }
    /**
     * 编辑课程
     */
    public static function postEditSerie()
    {
        $input = input('post.');
        if (empty($input['sid'])) {
            return result(-1, '你操作的课程不存在');
        }
        if (empty($input['pic'])) {
            return result(-1, '主图不能为空');
        }
        if (!isset($input['title']) || empty($input['title'])) {
            return result(-1, '标题不能为空');
        }
        $_data = array(
            'series_title' => $input['title'],
            'series_sub' => $input['subtitle'],
            'series_category' => $input['cate'],
            'series_pic' => $input['pic'],
            'series_price' => $input['price'],
            'series_content' => $input['content'],
            'series_status' => $input['status'],
            'series_teacher' => $input['teacher'],
        );
        $result = self::where('series_id', $input['sid'])->update($_data);
        if ($result) {
            return result(1, '编辑课程成功', $result);
        } else {
            return result(-1, '编辑课程失败', $result);
        }

    }
}
