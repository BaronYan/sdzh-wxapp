<?php
namespace app\common\model;

use think\Request;

class Managerlog extends Base
{
    protected $pk = 'ml_id';
    protected static function init()
    {
        //TODO:初始化内容
        // $s = new Request();
    }
    public function setLog($data = array())
    {
        if ($data['manager_id']) {
            $r = new Request();
            $_data = array(
                'manager_id' => $data['manager_id'],
                'ml_type' => isset($data['ml_type']) ? $data['ml_type'] : 1,
                'ml_time' => $r->time(),
                'ml_message' => isset($data['message']) ? $data['message'] : '',
            );
            $result = $this->data($_data)->save();
            if ($result) {
                return result(1, '日志记录成功', $result);
            } else {
                return result(-1, '日志记录出错,写入数据出错');
            }
        } else {
            return result(-1, '日志记录出错,用户ID为空');
        }
    }

}
