<?php
namespace app\common\validate;

use think\Validate;

class Cate extends Validate
{
  protected $rule = [
    'title' => 'require',
    'pid' => 'integer',
    'sort'=> 'integer'
  ];
  protected $message = [
    'name.require' => '分类名称不能为空',
    'pid.integer' => '父分类选择错误',
    'sort.integer' => '排序必须是整数'
  ];
}
