<?php
namespace app\common\controller;

class BaseApi extends Base
{
  protected $appID = 'wx891015813343d1ca';
  protected $appSecret = '230bb2e44f2050f3c0ad23534f517d1c';
  protected $wxLoginUrl = 'https://api.weixin.qq.com/sns/jscode2session?';
  protected function initialize(){
    parent::initialize();
    
  }
}
