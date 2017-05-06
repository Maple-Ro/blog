<?php
/**
 * Created by PhpStorm.
 * Description: analysis shadowsocks connection
 * Date: 2017/4/11 0011
 * Time: 17:51
 */
require './vendor/autoload.php';
 $dir = '/var/log';
$client = new MongoDB\Client();
$blog = $client->blog;
//查询所有已经写入数据库中的日志日期
$date_log = $blog->shadowsocks_date_log;

//读取/var/log目录中以shadowsocks.log开头的文件名字
$all_log_files = allFiles($dir);

foreach ($all_log_files as $i){
    $k= substr($i,0, 16);
   $res = $date_log->where('name', $k)->get();
   if($res===null){//无记录，处理数据，开启事务，写入数据
       handleData($blog->shadowsocks_static_log, $dir.$i);
   }
   $date_log->name = $k;
   $date_log->save();
}

function handleData(\MongoDB\Collection $db, string $filename){
    $contents = file_get_contents($filename);
    $array = explode("\n", $contents);
    $results = [];
    $i = 0;
    foreach ($array as $k => $v) {
        if (strpos($v, 'connecting') !== false) {
            $results[$i]['date'] = substr($v, 0, 19);
            $c_c = strpos($v, 'connecting') + 11;
            $site = substr($v, $c_c);
            list($site, $ip) = explode("from", $site);
            $results[$i]['site'] = trim($site);
            $results[$i]['ip'] = substr(trim($ip), 0, strpos(trim($ip), ":"));
            $results[$i]['create_at'] = date('Y-m-d H:i:s', time());
            $i++;
        }
    }
//筛选出同一ip的数量
    $results2 = [];
    foreach ($results as $k => $v) {
        $results2[$v['ip']] += 1;
    }
    $results3 = [];
    $j = 0;
    foreach ($results2 as $k => $v) {
        $results3[$j]['ip'] = $k;
        $results3[$j]['num'] = $v;
        $results3[$j]['created_at'] = \Carbon\Carbon::now();
        $results3[$j]['updated_at'] = \Carbon\Carbon::now();
        $j++;
    }
    
    $db->insertMany($results3);
}

function allFiles(string $dir):array
{
    //获取某目录下所有文件、目录名（不包括子目录下文件、目录名）
    $handler = opendir($dir);
    $files =$result= [];
    while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
        if ($filename != "." && $filename != "..") {
            $files[] = $filename;
        }
    }
    closedir($handler);
    foreach ($files as $k){
        if(strpos($k, 'shadowsocks.log-')!==false) $result[] = $k;
    }
    return $result;
}