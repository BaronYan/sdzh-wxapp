<?php
namespace app\common\controller;

class BaseAdmin extends Base
{
  protected function initialize(){
    parent::initialize();
    $this->authUser = session('auth_admin');
    $this->authUid = session('auth_uid');
    $this->defaultPath='/admin';
    $this->loginPath='/admin/login';
  }
}
