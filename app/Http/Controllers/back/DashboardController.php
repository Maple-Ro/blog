<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/20 0020
 * Time: 14:20
 */

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\SSD;
use App\Model\SSLog;
use App\Model\SSStatic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Linfo\Linfo;

class DashboardController extends Controller
{
    const IP_API = "http://ip-api.com/php/";

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
        $info = new Linfo();
        $parser = $info->getParser();
        //系统环境相关信息
        $distr = $parser->getDistro();
        $os = $parser->getOs();
        $distribution = $distr['name'] .' '. $distr['version'];
        $uptime = $parser->getUpTime()['text'];
        $uptime_booted = date('Y-m-d H:i:s', $parser->getUpTime()['bootedTimestamp']);
        $ernel =  $parser->getKernel();
        $HostName =  $parser->getHostName();//主机名
        $architecture = $parser->getCPUArchitecture();//cpu架构
        $PHPversion = $parser->getPhpVersion();//PHP版本
        $nginxVersion = '';
        $mysqlVersion = $this->mysqlVersion();
        $mongodbVersion = '';
        $redisVersion = '';
        //运行相关信息
        $load = $parser->getLoad();
//        echo 'load:', $load['now'] . $load['5min'] . $load['15min'], "\n";//cpu 使用量
        $ramUsage = $parser->getRam();
        $total = $ramUsage['total'] / 1024 / 1024;//Mb
        $free = $ramUsage['free'] / 1024 / 1024;//Mb
        $used = $total - $free;//Mb
        $space =  (disk_total_space('/') - disk_free_space('/')) / 1024 / 1024 / 1024;
        $space = number_format($space, 2, '.', '');
        return json_encode([
            'status' => 200,
            'success' => true,
            'info' => [
                'data' => [
                    ['cpu' => $load['15min']],
                    ['cpu' => $load['5min']],
                    ['cpu' => $load['now']]
                ],
                'usage' => $used,
                'space' => $space,
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
        if (!Cache::has('connect-info') && empty(Cache::get('connect-info'))) {
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
                sleep(1);
                if (!!$v['_id']) {
                    $result[$k]['ip'] = $v['_id'];
                    $result[$k]['count'] = $v['count'];
                    $addr = unserialize(file_get_contents(self::IP_API . $v['_id']));
                    if ($addr['status'] === 'success') {
                        $result[$k]['addr'] = $addr;
                    } else {
                        $result[$k]['addr'] = [];
                    }
                }
            }
            Cache::put('connect-info', $result, 12 * 60);
        } else {
            $result = Cache::get('connect-info');
        }

        return json_encode([
            'status' => 200,
            'success' => true,
            'data' => $result
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
//                $addr = json_decode(file_get_contents(html_entity_decode(self::IP_API ). $v['_id']));
//                $res[$k]['addr'] = $addr->country . ' ' . $addr->province . ' ' . $addr->city;
//        }
        return json_encode([
            'status' => 200,
            'success' => true,
            'data' => $res
        ]);
    }

    function dateLog(): array
    {
        if (!Cache::has('connect-date') && empty(Cache::get('connect-date'))) {
            $res = SSD::all()->toArray();
            Cache::put('connect-date', $res, 12 * 60);
        } else {
            $res = Cache::get('connect-date');
        }
        return $res;
    }

    function eachIpLog(string $ip): array
    {
        return SSLog::where('ip', $ip)->get()->toArray();
    }

    function chart(): string
    {
        if (!Cache::has('chart')) {
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
                if (!!$v['_id'] && $v['count'] > 1000) {
                    $addr = unserialize(file_get_contents(self::IP_API . $v['_id']));
                    array_push($result, [
                        'ip' => $v['_id'],
                        'count' => $v['count'],
                        'addr' => $addr,
                    ]);
                }
            }
            $data = $result;
            Cache::put('chart', $result, 24 * 60);
        } else {
            $data = Cache::get('chart');
        }
        return json_encode([
            'status' => 200,
            'data' => $data
        ]);
    }

    /**
     * 输出显示对应使用ss服务的地址信息
     * TODO mongodb 分组查询
     * @return string
     */
    function map()
    {
        if (!Cache::has('map')) {
            $res = SSStatic::raw(function ($collection) {
                return $collection->aggregate([
                    [
                        '$group' => [
                            '_id' =>[
                                'city'=>'$city',
                                'lon'=>'$lon',
                                'lat'=>'$lat'
                            ],
                            'count' => [
                                '$sum' => '$num'
                            ]
                        ]
                    ]
                ]);
            })->toArray();
            $result = [];
            foreach ($res as $k=>$v){
                $result[$k]['city'] = $v['_id']['city'];
                $result[$k]['lon'] = $v['_id']['lon'];
                $result[$k]['lat'] = $v['_id']['lat'];
                $result[$k]['count'] = $v['count'];
            }
//        $res = DB::table('shadowsocks_static_log')
//            ->select('city', 'lon', 'lat', DB::raw('sum(num) as total'))
//            ->groupBy('city')
//            ->orderBy('total', 'desc')
//            ->get()
//        ->toArray();
            $data = $result;
            Cache::put('map', $result, 24 * 60);
        } else {
            $data = Cache::get('map');
        }
        return json_encode($data);
//        return json_encode([
//            'status' => 200,
//            'data' => $data
//        ]);
    }

    private function mysqlVersion():string {
        try {
            $dsn = 'mysql:dbname=sys;host=127.0.0.1';
            $user = 'root';
            $password = '';
            $conn = new \PDO($dsn, $user, $password);
            $version = $conn->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
            $conn = null;
            return $version;
        } catch (\PDOException $e) {
            return '';
        }
    }
}