<?php
namespace app\common\model;

/**
 * 课程分类
 */
class ScCategory extends Base
{
    protected $pk = 'scc_id';

    /**
     * 创建课程分类
     */
    public static function add()
    {
        $input = input('post.');
        if (!isset($input['title']) || empty($input['title'])) {
            return result(-1, '分类名称不能为空');
        }
        $has = self::where('scc_title', $input['title'])->find();
        if ($has) {
            return result(-2, '分类名称已经存在');
        }
        $_data = array();
        $_data['scc_title'] = $input['title'];
        $_data['scc_pid'] = 0;
        $_data['scc_sort'] = 0;
        if (isset($input['pid']) && !empty($input['pid'])) {
            $_data['scc_pid'] = $input['pid'];
        }
        if (isset($input['sort']) && !empty($input['sort'])) {
            $_data['scc_sort'] = $input['sort'];
        }
        $result = self::insert($_data);
        if ($result) {
            return result(1, '创建课程分类成功', $result);
        } else {
            return result(-2, '创建课程分类失败');
        }
    }

    public static function edit()
    {
        $input = input('post.');
        if (!isset($input['title']) || empty($input['title'])) {
            return result(-3, '标题不能为空');
        }
        if (isset($input['sccid']) && !empty($input['sccid'])) {
            $hasid = self::where('scc_id', $input['sccid'])->find();
            if ($hasid) {
                $hasTitle = self::where('scc_title', $input['title'])->find();
                if ($hasTitle && $input['sccid'] != $hasTitle['scc_id']) {
                    return result(-4, '分类名称已经存在');
                } else {
                    $_data['scc_title'] = $input['title'];
                    $_data['scc_pid'] = $input['pid'];
                    $_data['scc_sort'] = $input['sort'];
                    $result = self::where('scc_id', $input['sccid'])->update($_data);
                    if ($result) {
                        return result(1, '编辑课程分类成功', $result);
                    } else {
                        return result(-1, '编辑课程分类失败');
                    }
                }
            } else {
                return result(-2, '非法操作');
            }
        } else {
            return result(-1, '非法操作');
        }
    }
    public static function del()
    {
        $sccid = input('get.sccid');
        $hasid = self::where('scc_id', $sccid)->find();
        if ($hasid) {
            $result = self::destroy($sccid);
            if ($result) {
                return result(1, '删除课程分类成功', $result);
            } else {
                return result(-1, '删除课程分类失败');
            }
        } else {
            return result(-1, '非法操作');
        }
    }

    public static function getCate()
    {
        $list = self::order('scc_sort,scc_pid')->select();
        return $list;
        if (count($list) > 1) {
            return self::getCateWithChild($list);
        } else {
            return $list;
        }
    }
    /**
     * 格式化分类数据
     */
    private static function getChildren($cate, $scc_pid = 0, $level = 0)
    {
        $arr = array();
        foreach ($cate as $c) {
            if ($c['scc_pid'] == $scc_pid) {
                if ($level == 0) {
                    $c['title'] = $c['scc_title'];
                } else {
                    $html = '─';
                    for ($i = 0; $i < $level; $i++) {
                        // $html = '&nbsp;&nbsp;';
                        $html .= '─';
                    }
                    $c['title'] = $html . '└' . $c['scc_title'];
                }
                $c['level'] = $level;
                $arr[] = $c;
                $arr = array_merge($arr, self::getChildren($cate, $c['scc_id'], $level + 1));
            }
        }
        return $arr;
    }
    /**
     * 格式化子分类
     * 无线级分类
     */
    private static function getCateWithChild($cate, $scc_pid = 0)
    {
        $arr = array();
        foreach ($cate as $c) {
            if ($c['scc_pid'] == $scc_pid) {
                $c['child'] = self::getCateWithChild($cate, $c['scc_id']);
                $arr[] = $c;
            }
        }
        return $arr;
    }
}
