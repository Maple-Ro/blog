<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/6 0006
 * Time: 21:04
 */

namespace App\Http\Controllers\Back;


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

    function __construct()
    {
    }

    /**
     * 插入单条记录
     * @param Request $request
     * @return string id主键
     */
    function add(Request $request): string
    {
        $article = new Article();
//        $data = $request->data;
        $article->content = '222';
//        $article->setDateFormat('Y-m-d H:i:s');
//        $article->content = $data->content;
//        $article->weekday = $data->weekday;
//        $article->title = $data->title;
        $article->save();
        return $this->article->id;
    }

    function all(): array
    {
        return Article::all();
    }

    function one(string $id): Article
    {
        return Article::where('_id', 'one', $id)->get();
    }

    function del(string $id): bool
    {
        $article = $this->one($id);
        $article->status = 0;//0表示删除了的
        $article->save();
    }

}