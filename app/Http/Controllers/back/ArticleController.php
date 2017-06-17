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
use App\Model\Tags;
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

    /**
     * @deprecated
     * mock data
     * @return string
     */
    private function create(): string
    {
        for ($i = 0; $i < 40; $i++) {
            $random = random_int(1, 10000);
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
            $instance->is_draft = random_int(0, 1);
            $res = $instance->save();
        }
        if ($res) {
            return json_encode([
                'status' => 200,
                'msg' => 'success'
            ]);
        } else {
            return json_encode([
                'status' => 400,
                'msg' => 'wrong'
            ]);
        }
    }

    function lists(Request $request)
    {
        $page = $request->page ?: 1;
        $page_size = intval($request->pageSize) ?: 6;
        $field = $request->field ?: '';
        $keyword = $request->keyword ?: '';
        if (!!$field) {
            $data = Article::where($field, 'like', '%' . $keyword . '%')->forPage($page, $page_size)->get();
        } else {
            $data = Article::forPage($page, $page_size)->get();
        }
        $total = count(Article::all()->toArray());
        return successWithData([
            'data' => $data,
            'pagination' => [
                'current' => $page,
                'total' => $total
            ]
        ]);
    }

    function del(Request $request)
    {
        $id = $request->id;
        if (empty($id)) return fail(1000, 'id needed!');
        try {
            if ($this->delOne($id)) {
                return successWithoutData();
            }
        } catch (\Exception $e) {
            return fail(400, $e->getMessage());
        }
    }

    function down(Request $request)
    {
        return $this->modify($request->id, false);
    }

    function up(Request $request)
    {
        return $this->modify($request->id, true);
    }

    private function modify(string $id, bool $state)
    {
        if (empty($id)) return fail(1000, 'id needed!');
        try {
            $article = Article::find($id);
            $article->state = $state;
            $article->save();
            return successWithoutData();
        } catch (\Exception $e) {
            return fail(400, $e->getMessage());
        }
    }

    /**
     * 新增/修改
     * @return string
     */
    function post()
    {
        try {
            $title = \request('title');
            $id = \request('id', 0);
            if (!!$id) {
                $article = Article::find($id);
            } else {
                $article = new Article();
            }
            $article->title = $title;
            $article->content = \request('content');
            $article->category = \request('category');
            $article->state = \request('state') === 'true';
            $article->tags = \request('tags');
            $this->saveTags($article->tags);
            $article->save();
            return successWithoutData();
        } catch (\Exception $e) {
            return fail(400, $e->getMessage());
        }
    }

    /**
     * 上传图片
     * @return string
     */
    function upload()
    {
        $file = $_FILES['file'];
        if ($file['error'] != 0) fail(400, '上传失败');
        if ($file['size'] > 2 * 1024 * 1024) fail(400, '上传失败');
        if (!getimagesize($file['tmp_name'])) fail(400, '上传失败');
        $name = md5($file['tmp_name'] . time());
        $ext = explode('/', $file['type'])[1];
        $dest = env('RESOURCE_PATH') . '/' . date('ymd');
        if (!is_dir($dest)) {
            mkdir($dest, 0777, true);
            chmod($dest, 0777);
        }
        $r = move_uploaded_file($file['tmp_name'], $dest . '/' . $name . '.' . $ext);
        if ($r) {
            return successWithData([
                'path' => '/' . date('ymd') . '/' . $name . '.' . $ext
            ]);
        } else {
            fail(400, '上传失败');
        }
    }

    function content(): string
    {
        $id = \request('id');
        $content = !empty(Article::find($id)->content) ? Article::find($id)->content : '';
        return successWithData([
            'content' => $content
        ]);
    }

    /**
     * 保存提交的tags，确保每个tags唯一，区分大小写 TODO
     * @param array $tags
     */
    function saveTags(array $tags)
    {
        foreach ($tags as $k => $v) {
            $tag = Tags::where('name', $v)->get()->toArray();
            if (!empty($tag)) continue;
            $tag = new Tags();
            $tag->name = $v;
            $tag->save();
            unset($tag);
        }
    }
}