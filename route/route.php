<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//api
Route::get('/api/openid', 'api/Index/wxGetOpenid');
Route::post('/api/userinfo', 'api/Index/wxGetUserInfo');
Route::get('/api/banner', 'api/Index/getBanner');
Route::get('/api/series', 'api/Index/getSeries');
Route::post('/api/myseries', 'api/Index/getMySeries');
Route::rule('/api/seriesbyid', 'api/Index/getSeriesById');
Route::get('/api/about', 'api/Index/aboutus');
// admin/main
Route::get('/admin$', 'admin/Main/index');
// admin/index
Route::get('admin/login', 'admin/Index/login')->name('adminlogin'); // 登录页面
Route::post('admin/checklogin', 'admin/Index/checkLogin'); // 登录认证
Route::get('admin/logout', 'admin/Index/logout'); // 退出登录
Route::get('admin/verify', 'admin/Index/getVerify'); // 获取验证码
// admin/cate
Route::post('admin/addcate', 'admin/Category/add');
Route::post('admin/editcate', 'admin/Category/edit');
Route::get('admin/cate', 'admin/Category/index');
// admin/kecheng
Route::rule('admin/kecheng/add', 'admin/Series/add');
Route::rule('admin/kecheng$', 'admin/Series/list');
// 编辑系列课程
Route::rule('admin/kecheng/edit/:sid', 'admin/Series/apiEdit');
Route::rule('admin/keshi/add/[:serieslist]', 'admin/Course/add'); // 添加课时
Route::post('admin/keshi/addcourse$', 'admin/Course/addCourse'); // 添加课时
// 编辑课时
Route::rule('admin/keshi/edit/:cid', 'admin/Course/apiEdit');
// 班级
Route::rule('admin/banji/add', 'admin/Classes/add');
Route::get('admin/banji$', 'admin/Classes/index');

Route::post('/admin/banji/addstu', 'admin/Classes/addstu');
Route::post('/admin/banji/addser', 'admin/Classes/addser');

Route::get('admin/xueyuan', 'admin/Student/index');

Route::get('admin/addseries', 'admin/Series/createSeriesCate');
Route::get('admin/test', 'admin/Test/index');

Route::get('abc', 'admin/qiniu.Qiegeshipin/index');
Route::get('notify', 'admin/qiniu.Qiegeshipin/notify');
// admin/banner
Route::post('admin/banner/add', 'admin/Banner/add');
Route::get('admin/banner/del/:imgid', 'admin/Banner/del');
Route::get('admin/banner', 'admin/Banner/index');

// 文章管理
Route::rule('admin/aboutme', 'admin/Posts/aboutme');
