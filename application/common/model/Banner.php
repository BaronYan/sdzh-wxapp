<?php
namespace app\common\model;

/**
 * banner管理
 */
class Banner extends Base
{
    protected $pk = 'banner_id';

    public static function add()
    {
        $input = input('post.');
        $file = request()->file('imgurl');
        $info = $file->validate(['size' => 20 * 1024 * 1024, 'ext' => 'jpeg,jpg,png,gif'])->move('./uploads');
        if ($info) {
            $input['imgurl'] = $info->getSaveName();
        } else {
            return result(-1, $file->getError());
        }
        $_data = array();
        $_data['banner_title'] = isset($input['title']) ? $input['title'] : '0';
        $_data['banner_url'] = $input['imgurl'];
        $_data['banner_sort'] = isset($input['sort']) ? $input['sort'] : '0';
        $_data['addtime'] = time();
        $ret = self::insert($_data);
        if ($ret) {
            return result(1, '添加图片成功');
        } else {
            return result(-1, '添加数据失败');
        }
    }
    public static function del()
    {
        $imgid = input('imgid');
        $has = self::where('banner_id', $imgid)->find();
        if ($has) {
            $path = $has['banner_url'];
            $ret = self::destroy($imgid);
            @unlink('./uploads/' . $path);
            if ($ret) {
                return result(1, '删除图片成功');
            } else {
                return result(-1, '删除图片失败');
            }
        } else {
            return result(-1, '非法操作');
        }
    }
    public static function get()
    {
        return self::order('banner_sort,addtime desc')->select();
    }
}
