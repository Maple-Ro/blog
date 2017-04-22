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
     * 添加单条记录
     * @param Request $request
     * @return string id主键
     */
    function add(Request $request): bool
    {
        $article = new Article();
        return $this->insert($request, $article);
    }

    /**
     * 所有记录
     * @return array
     */
    function all(): array
    {
        return Article::all();
    }

    /**
     * 根据id获取文章
     * @param string $id
     * @return Article
     */
    function one(string $id): Article
    {
        return Article::find($id);
    }

    /**
     * 删除多个记录
     * @param array $ids
     * @return int
     */
    function delMany(array $ids): int
    {
        return Article::destroy($ids);
    }

    /**
     * 删除单个记录
     * @param string $id
     * @return int
     */
    function delOne(string $id): int
    {
        return Article::destroy($id);
    }

    /**
     * 更新单个字段
     * @param String $id
     * @param string $field
     * @param string $data
     * @return bool
     */
    function updateOneField(String $id, string $field, string $data): bool
    {
        $artice = $this->one($id);
        try {
            $artice->$field = $data;
            return $artice->save();
        } catch (\Exception $e) { //找不到字段
            return false;
        }
    }

    /**
     * 更新整条记录
     * @param Request $request
     * @param string $id
     * @return bool
     */
    function update(Request $request, string $id): bool
    {
        $article = $this->one($id);
        return $this->insert($request, $article);
    }

    /**
     * 插入记录
     * @param Request $request
     * @param Article $article
     * @return bool
     */
    private function insert(Request $request, Article $article): bool
    {
        try {
            $article->content = $request->data->content;
            $article->title = $request->data->title;
            $article->label = $request->data->label;
            return $article->save();
        } catch (\Exception $e) {
            return false;
        }
    }

    //TODO 插入新的字段
    function create(Request $request): string
    {
        $random =random_int(1,10000);
        $title = '测试1';
        $content = '测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1
        测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1
        测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1
        测试1测试1测试1测试1测试1测试1测试1测试1';
        $title = str_replace('1', $random, $title);
        $content = str_replace('1', $random, $content);
        $instance = new Article();
        $instance->title = $title;
        $instance->content = $content;
        $res = $instance->save();
       if($res){
           return json_encode([
               'status'=>200,
               'msg'=>'success'
           ]);
       }else{
           return json_encode([
               'status'=>400,
               'msg'=>'wrong'
           ]);
       }
    }

    function lists(Request $request)
    {
        $page = $request->page;
        $page_size = intval($request->page_size) ?: 6;
        $data = Article::forPage($page, $page_size)->get();
        return json_encode([
            'status'=>200,
            'data'=>$data
        ]);
    }
}