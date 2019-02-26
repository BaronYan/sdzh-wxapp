<?php
namespace app\admin\controller\qiniu;

use Qiniu\Auth;
// use Qiniu\Config;
use Qiniu\Processing\PersistentFop;

class Qiegeshipin
{

    public function index()
    {
        $accessKey = 'MpvhTG-2Df17lWjRQomvHz7ICgdH_tgjxggxWA8K';
        $secretKey = 'dgVxFCqpsTaigz8jFlKomYju_tR6IN3Ow9uo0EPj';
        $bucket = 'bangbby';
        $auth = new Auth($accessKey, $secretKey);
        //要转码的文件
        $key = '2-13 开发环境及配置相关考点.mp4';
        //转码使用的队列名称
        $pipeline = 'line1';
        $force = false;
        //转码完成后通知到你的业务服务器。
        $notifyUrl = 'http://vip.gzsdzh.com/notify';
        $config = new \Qiniu\Config();
        $pfop = new PersistentFop($auth, $config);
        //要进行转码的转码操作。
        $fops = "avthumb/m3u8/noDomain/1/pattern/wahahahahaha" . \Qiniu\base64_urlSafeEncode($bucket . ":qiniu_640x360.mp4");
        list($id, $err) = $pfop->execute($bucket, $key, $fops, $pipeline, $notifyUrl, $force);
        echo "\n====> pfop avthumb result: \n";
        if ($err != null) {
            var_export($err);
        } else {
            echo "PersistentFop Id: $id\n";
        }
        //查询转码的进度和状态
        list($ret, $err) = $pfop->status($id);
        echo "\n====> pfop avthumb status: \n";
        if ($err != null) {
            var_dump($err);
        } else {
            var_dump($ret);
        }
    }
    public function notify()
    {
        $notify=file_get_contents("php://input");
        error_log($notify);
    }
}
