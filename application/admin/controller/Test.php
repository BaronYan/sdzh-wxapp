<?php
namespace app\admin\controller;

require_once __dir__ . '/../../../vendor/autoload.php';

use Qiniu\Auth;
// Vendor('sdk.autoload');
use Qiniu\Storage\BucketManager;
use think\Controller;

class Test extends Controller
{
    public function index()
    {
        // 用于签名的公钥和私钥
        $accessKey = 'A19dfJVoNU_F3O9ZkEzVnLbRiNPuFZa4DVhtucV_';
        $secretKey = '8TTyov_NB-XYSbN_NKAQt4VKyoDbdDC1KjBkjsEq';
        $bucket = 'bangbby';
        // 要列取文件的公共前缀
        $prefix = '';
        // 上次列举返回的位置标记，作为本次列举的起点信息。
        $marker = '';
        // 本次列举的条目数
        $limit = 10;
        $delimiter = '/';
        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);
        //初始化BucketManager
        $bucketManager = new BucketManager($auth);
        list($ret, $err) = $bucketManager->listFiles($bucket, $prefix, $marker, $limit, $delimiter);
        if ($err !== null) {
            echo "\n====> list file err: \n";
            var_dump($err);
        } else {
            var_export($ret);die;
            if (array_key_exists('marker', $ret)) {
                echo "Marker:" . $ret["marker"] . "\n";
            }
            echo "\nList Iterms====>\n";
        }
    }
    public function file()
    {
        var_dump(__file__);
    }
    public function sendmail()
    {
        return '123';
    }
}
