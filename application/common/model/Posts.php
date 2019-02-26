<?php
namespace app\common\model;

/**
 * banner管理
 */
class Posts extends Base
{
    protected $pk = 'posts_id';

    public static function editAboutUS()
    {
        $input = input('post.');
        $has = self::where('posts_type', 3)->find();
        $_data = array(
            'posts_type' => 3,
            'posts_title' => !empty($input['title']) ? $input['title'] : '',
            'posts_content' => !empty($input['content']) ? $input['content'] : '',
            'posts_editime' => time(),
        );
        if ($has) {
            $ret = self::where('posts_id', $has['posts_id'])->update($_data);
        } else {
            $_data['posts_addtime'] = time();
            $ret = self::insert($_data);
        }
        if ($ret) {
            return result(1, '操作成功');
        } else {
            return result(-1, '操作失败');
        }

    }
    public static function getAboutUS()
    {
        return self::where('posts_type', 3)->find();
    }

}
