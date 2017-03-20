<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/3/20 0020
 * Time: 9:36
 */

namespace app\Http\Controllers\front;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return frontView('common.mother');
    }
}