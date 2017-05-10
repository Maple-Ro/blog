<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/20 0020
 * Time: 14:20
 */

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use App\Model\SSD;
use App\Model\SSLog;
use App\Model\SSStatic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    const IP_API = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&amp;ip=";
//    const IP_API = 'http://ip.dreamlist.cc/api/?ip=';

    /**
     * 天气信息
     * @return string
     */
    function weather(): string
    {
        return json_encode([
            'status' => 200,
            'success' => true,
            'weather' => [
                'city' => '浦东',
                'icon' => 'http://www.zuimeitianqi.com/res/icon/0_big.png',
                'dateTime' => Carbon::now()->format('m-d H:i'),
                'temperature' => '26',
                'weatherName' => 'cloudy'
            ]
        ]);
    }

    /**
     * 系统运行信息
     * @return string
     */
    function os(): string
    {
        return json_encode([
            'status' => 200,
            'success' => true,
            'info' => [
                'data' => [
                    ['cpu' => 20],
                    ['cpu' => 38],
                    ['cpu' => 34],
                    ['cpu' => 56],
                    ['cpu' => 78],
                    ['cpu' => 34],
                    ['cpu' => 25],
                    ['cpu' => 67],
                    ['cpu' => 87],
                    ['cpu' => 56],
                    ['cpu' => 67],
                    ['cpu' => 34],
                    ['cpu' => 88],
                    ['cpu' => 76],
                    ['cpu' => 43],
                    ['cpu' => 23],
                    ['cpu' => 45],
                    ['cpu' => 43],
                    ['cpu' => 65],
                    ['cpu' => 88],
                ],
                'usage' => 35,
                'space' => 30,
                'cpu' => 50
            ]
        ]);

    }

    function card(): string
    {
        return json_encode([
            'status' => 200,
            'success' => true,
            'data' => [
                [
                    'color' => '#64ea91',
                    'icon' => 'pay-circle-o',
                    'number' => 2791,
                    'title' => 'Page View',
                ],
                [
                    'color' => '#a4eaf1',
                    'icon' => 'team',
                    'number' => 1234,
                    'title' => 'Total View',
                ],
                [
                    'color' => '#6423f1',
                    'icon' => 'message',
                    'number' => 1231,
                    'title' => 'Online Review',
                ],
                [
                    'color' => '#65acd1',
                    'icon' => 'shopping-cart',
                    'number' => 1231,
                    'title' => 'Referrals',
                ],
            ]
        ]);
    }

    /**
     * @return string
     */
    function browser(): string
    {
        return json_encode([
            'status' => 200,
            'success' => true,
            'data' => [
                [
                    'name' => 'Google Chrome',
                    'percent' => 43.3,
                    'status' => 1
                ], [
                    'name' => "Mozilla Firefox",
                    'percent' => 33.4,
                    'status' => 3
                ], [
                    'name' => "Apple Safari",
                    'percent' => 34.6,
                    'status' => 4
                ], [
                    'name' => "Internet Explorer",
                    'percent' => 12.3,
                    'status' => 2
                ], [
                    'name' => "Opera Mini",
                    'percent' => 3.3,
                    'status' => 4
                ], [
                    'name' => "Chromium",
                    'percent' => 2.53,
                    'status' => 3
                ],
            ]
        ]);
    }

    /**
     * 统计每个ip的访问次数
     * @return string
     */
    function connectingInfo(): string
    {
        if(!Cache::has('connect-info')&&empty(Cache::get('connect-info'))){
            $res = SSStatic::raw(function ($collection) {
                return $collection->aggregate([
                    [
                        '$group' => [
                            '_id' => '$ip',
                            'count' => [
                                '$sum' => '$num'
                            ]
                        ]
                    ]
                ]);
            })->toArray();
            $result = [];
            foreach ($res as $k => $v) {
                if (!!$v['_id']) {
                    $result[$k]['ip'] = $v['_id'];
                    $result[$k]['count'] = $v['count'];
                    $addr = json_decode(file_get_contents(htmlspecialchars_decode(self::IP_API ). $v['_id']));
                    $result[$k]['addr'] = $addr->country . ' ' . $addr->province . ' ' . $addr->city;
                }
            }
            Cache::put('connect-info', $result,12*60);
        }else{
            $result = Cache::get('connect-info');
        }
        return json_encode([
            'status'=>200,
            'success' => true,
            'data'=>$result
        ]);
    }

    /**
     * 统计每个ip的访问次数
     * @return array
     */
    function connectDetail(): string
    {
        $res = SSLog::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$ip',
                        'count' => [
                            '$sum' => 1
                        ]
                    ]
                ]
            ]);
        })->toArray();
//        foreach ($res as $k => $v) {
//                $addr = json_decode(file_get_contents(htmlspecialchars_decode(self::IP_API ). $v['_id']));
//                $res[$k]['addr'] = $addr->country . ' ' . $addr->province . ' ' . $addr->city;
//        }
//        return json_encode([
//            'status'=>200,
//            'success' => true,
//            'data'=>$res
//        ]);
        return html_entity_decode(self::IP_API);
    }

    function dateLog(): array
    {
        return SSD::all()->toArray();
    }

    function eachIpLog(string $ip): array
    {
        return SSLog::where('ip', $ip)->get()->toArray();
    }

}