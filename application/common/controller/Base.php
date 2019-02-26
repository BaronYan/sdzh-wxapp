<?php
namespace app\common\controller;

use think\Controller;

class Base extends Controller
{
    protected $dev = true; // 是否是开发模式
    protected $defaultPath = '/';
    protected $loginPath = '/login';
    protected $authUser = '';
    protected $authUid = '';
    /**
     * 初始化
     */
    protected function initialize()
    {
        $token = $this->request->token('__token__', 'sha1');
        $this->assign('token', $token);
        if ($this->dev) {
            $this->assign('timestamp', time());
        } else {
            $this->assign('timestamp', 'v1.1.0');
        }
        $this->assign('siteTitle', '舍德教育'); // 网站标题
        $this->assign('brand', '舍德教育');
        $this->assign('pageTitle', ''); // 页面标题
        $this->assign('iconFont', '//at.alicdn.com/t/font_956938_87h36iudlg2.css'); // 图标
    }
    protected function _jump($result, $url = '')
    {
        if ($result['status'] > 0) {
            $this->success($result['message'], $url);
        } else {
            $this->error($result['message']);
        }
    }
    protected function upload($filedname = '', $size = 20480, $ext = 'jpg,png,gif')
    {
        $success = array();
        $error = array();
        // 获取表单上传文件
        $files = request()->file($filedname);
        foreach ($files as $file) {
            $info = $file->validate(['size' => $size, 'ext' => $ext])->move('/uploads');
            if ($info) {
                $success[] = $info->getSaveName();
            } else {
                // 上传失败获取错误信息
                $error[] = $file->getError();
            }
        }
        return array('success' => $success, 'error' => $error);
    }
}
