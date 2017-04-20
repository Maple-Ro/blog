<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/20 0020
 * Time: 14:20
 */

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use Carbon\Carbon;

class WeatherController extends Controller
{

    function weather(): string
    {
        $results = callThirdApi($this->generateUrl());
        $city = $results->location->name;
        $temperature = $results->now->temperature;
        $icon = '//tsing.studio/themes/back/images/3d_60/' . $results->now->code . '.png';
        return json_encode([
            'city' => $city,
            'icon' => $icon,
            'dateTime' => Carbon::now()->format('Y-m-d H:i:s'),
            'temperature' => $temperature,
            'name' => 'Endless'
        ]);
    }

    private function generateUrl(): string
    {
        $location = "WTW3T7RMWMB4"; // 除拼音外，还可以使用 v3 id、汉语等形式
        $key = "lao1dyz4kowfbvbl"; // 测试用 key，请更换成您自己的 Key
        $uid = "U1F369AE24"; // 测试用 用户ID，请更换成您自己的用户ID
// 获取当前时间戳，并构造验证参数字符串
        $keyname = "ts=" . time() . "&ttl=300&uid=" . $uid;
// 使用 HMAC-SHA1 方式，以 API 密钥（key）对上一步生成的参数字符串（raw）进行加密
        $sig = base64_encode(hash_hmac('sha1', $keyname, $key, true));
// 将上一步生成的加密结果用 base64 编码，并做一个 urlencode，得到签名sig
        $signedkeyname = $keyname . "&sig=" . urlencode($sig);
// 最终构造出可由前端或服务端进行调用的 url
        return "https://api.thinkpage.cn/v3/weather/now.json?location=" . $location . "&" . $signedkeyname;
    }
}