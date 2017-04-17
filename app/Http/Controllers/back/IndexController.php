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
        return backView('page.index');
    }

    function back()
    {
        return redirect('http://user-dashboard.io');
    }
}