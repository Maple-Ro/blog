<?php
/**
 * Created by PhpStorm.
 * Description: analysis shadowsocks connection
 * Date: 2017/4/11 0011
 * Time: 17:51
 */
require './vendor/autoload.php';
$contents = file_get_contents('./storage/app/shadowsocks.log');
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
    $j++;
}
$shadowsocks_log = (new MongoDB\Client())->blog->shadowsocks_log;
$shadowsocks_static_log = (new MongoDB\Client())->blog->shadowsocks_static_log;
$shadowsocks_log->insertMany($results);
$shadowsocks_static_log->insertMany($results3);