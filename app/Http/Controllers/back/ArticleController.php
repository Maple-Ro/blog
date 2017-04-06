<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/6 0006
 * Time: 21:04
 */

namespace App\Http\Controllers\back;


use App\Http\Controllers\Controller;
use App\Model\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //增删改查
    //单个增加
    //单个/多个删除
    //单个修改
    //单个/多个查找

    function insert(Request $request)
    {
        $data = $request->data;
        $article = new Article();
        $article->content = $data->content;
        $article->weekday = $data->weekday;
        $article->title = $data->title;
        $article->id =
            $article->save();

    }

}