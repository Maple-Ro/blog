<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/3/20 0020
 * Time: 9:42
 */

namespace App\Http\Controllers\back;


use App\Http\Controllers\Controller;
use App\Model\Info;

class IndexController extends Controller
{
    function index()
    {
        return view('welcome');
    }

    function insert()
    {
//        Info::create([
//            'name' => 'MapleImage',
//            'email' => 'liutsingluo@163.com',
//            'description' => 'Hope is a good thing'
//        ]);
        return Info::all();
    }
//    function insert2(){
//        $info = new Info;
//        $info->name = 'John';
//        $info->save();
//    }

}