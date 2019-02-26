<?php
namespace app\common\model;

use think\Request;

class Config extends Base
{
    protected $pk = 'config_id';
    protected $config = '';
    protected static function init()
    {
        $s = new Request();
        //TODO:初始化内容
    }
    public function add()
    {

    }
    public function edit()
    {
        # code...
    }
    public function del()
    {
        # code...
    }
    function list() {
        # code...
    }
}
