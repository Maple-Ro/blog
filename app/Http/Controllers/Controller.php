<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function call(string $url, array $params = [])
    {
        return callApiServer($url, $params);
    }

    /**
     * 跨域请求输出方法
     * @param string $contents
     * @param string|null $self_header
     * @return mixed
     */
    protected function res(string $contents, string $self_header = null)
    {
        if (!!$self_header) {
            $result = response($contents)->header('x-total-count', $self_header);
        } else {
            $result = response($contents);
        }
        return $result
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin')
            ->header('Content-Type', 'text/json');
    }
}
