<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function call(string $url, array $params = [])
    {
        return callApiServer($url, $params);
    }

    /**
     * 跨域请求输出方法
     * @param array $data
     * @return mixed
     */
    protected function res(array $data)
    {
        return response()->json($data);
    }
}
