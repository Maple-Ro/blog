<?php

namespace App\Http\Controllers\front;

use App\Model\SSLog;
use App\Model\SSStatic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    /**
     * for test
     */
    function add()
    {
//        $contents = Storage::disk('local')->get('shadowsocks.log');
//        $array = explode("\n", $contents);
//        $results = [];
//        $i=0;
//        foreach ($array as $k=>$v){
//            if(strpos($v, 'connecting')!==false){
//                $results[$i]['date'] = substr($v, 0, 19);
//                $c_c = strpos($v, 'connecting')+11;
//                $site = substr($v, $c_c) ;
//                list($site, $ip) = explode("from", $site);
//                $results[$i]['site'] = trim($site);
//                $results[$i]['ip'] = substr(trim($ip),0, strpos(trim($ip),":"));
//                $results[$i]['create_at'] = date('Y-m-d H:i:s',time());
//                $i++;
//            }
//        }
//        SSLog::insert($results);
    }

    /**
     * for test
     */
    function sum()
    {
//        $result = SSLog::all(['site'])->groupBy('ip');
//        return $result;
//        $ips = SSLog::distinct('ip')->get()->toArray();
//        $result=[];
//        foreach ($ips as $k=>$v){
//            $v = $v[0];
//            $num = SSLog::all()->where('ip', '=', $v)->count();
//            $result[$k]['ip'] = $v;
//            $result[$k]['num'] = $num;
//        }
//
//        SSStatic::insert($result);
    }
}
