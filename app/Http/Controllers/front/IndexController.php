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
        $r = $this->call('/web/article_list');
        if ($r->code != 200) {
            $data = [];
        } else {
            $data = $r->data;
        }
        return frontView('content')->with(compact(['data']));
    }
}