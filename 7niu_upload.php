<?php
/**-----------------------------------------------------------------  */
/**-- 每周六定时任务上传备份压缩好的mongodb数据库文件       */
/**-----------------------------------------------------------------  */
require_once __DIR__ . '/vendor/autoload.php';
// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

$filePath = $argv[1];
// 需要填写你的 Access Key 和 Secret Key
$accessKey = \Yaconf::get("blog.accessKey");
$secretKey = \Yaconf::get("blog.secretKey");
// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);
// 要上传的空间
$bucket = 'blog';
// 生成上传 Token
$token = $auth->uploadToken($bucket);
// 要上传文件的本地路径
//$filePath = '/var/log/mongodb/blog.tar.gz';
// 上传到七牛后保存的文件名
$key = "backup" . date('ymd') . ".zip";
// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();
// 调用 UploadManager 的 putFile 方法进行文件的上传。
list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
echo "\n====> putFile result: \n";
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}