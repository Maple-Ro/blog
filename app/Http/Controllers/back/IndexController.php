<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/3/20 0020
 * Time: 9:42
 */

namespace app\Http\Controllers\back;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    function index()
    {
        return view('welcome');
    }

}