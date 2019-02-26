<?php
namespace app\api\controller;

use app\common\controller\BaseApi;
use app\common\model\Banner;
use app\common\model\Posts as PO;
use app\common\model\Series;
use app\common\model\Student;

class Index extends BaseApi
{
    /**
     * 小程序登录
     */
    public function wxGetOpenid()
    {
        $code = input('code');
        if ($code) {
            $url = $this->wxLoginUrl . 'appid=' . $this->appID . '&secret=' . $this->appSecret . '&js_code=' . $code . '&grant_type=authorization_code';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            $ret = curl_exec($curl);
            curl_close($curl);
            if (isset($ret['err']) && !empty($ret['err'])) {
                return json(result(-1, '获取用户信息失败'));
            } else {
                $ret = json_decode($ret, true);
                if (isset($ret['openid'])) {
                    session('auth_openid', $ret['openid']);
                    Student::add(array('student_openid' => $ret['openid']));
                }
                return json(result(1, $ret));
            }
        } else {
            return json(result(-1, '获取code失败'));
        }
    }
    public function wxGetUserInfo()
    {
        $ret = Student::add2();
        return json(result(1, $ret));
    }
    /**
     * 获取banner信息
     */
    public function getBanner()
    {
        $url = 'https://vip.gzsdzh.com/uploads/';
        $list = Banner::get();
        foreach ($list as $key => $value) {
            $list[$key]['banner_url'] = $url . $value['banner_url'];
        }
        return json($list);
    }
    public function getSeries()
    {
        $list = Series::get();
        return json($list);
    }
    /**
     * 获取课程信息
     */
    public function getSeriesById()
    {
        $list = Series::getseriesById();
        return json($list);
    }
    public function getMySeries()
    {
        $list = Series::getmyseries();
        return json($list);
    }
    /**
     * 根据系列ID获取课程信息
     */
    public function getcourseByid()
    {
        $list = Series::getmycourse();
        return json($list);
    }

    public function aboutus()
    {
        $about = PO::getAboutUS();
        return json(result(1, $about));
    }
}
