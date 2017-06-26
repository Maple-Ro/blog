<?php

namespace app\Http\Controllers\back;


use App\Http\Controllers\Controller;
use App\Model\Category;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('token');
    }
    function list(): string
    {
        $list = Category::all()->toArray();
        return successWithData([
            'catelist' => $list
        ]);
    }

    function post(): string
    {
        try {
            $name = trim(\request('name'));
            $id = \request('id', 0);
            $isRepeat = Category::where('name', $name)->where('_id', '<>', $id)->get()->toArray();
            if (count($isRepeat)) {
                return json_encode([
                    'status' => 200,
                    'data' => [
                        'success' => false,
                        'message' => "分类名{$name}已存在"
                    ]
                ]);
            }
            if (!!$id) {
                $article = Category::find($id);
            } else {
                $article = new Category();
            }
            $article->name = $name;
            $article->save();
            return successWithoutData();
        } catch (\Exception $e) {
            return fail(400, $e->getMessage());
        }
    }
}