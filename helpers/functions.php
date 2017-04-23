<?php
use Illuminate\Support\Facades\Storage;

/**
 * Description:  一些有用的函数
 * User: Endless
 * Date: 2017/3/19
 * Time: 19:40
 */
if (!function_exists('homeAssets')) {
    function homeAssets(string $path, boolean $secure = null)
    {
        $themes = THEMES_NAME . DIRECTORY_SEPARATOR . Config::get('app.themes');
        return app('url')->asset($themes . $path, $secure);
    }
}
if (!function_exists('backAssets')) {
    function backAssets(string $path, boolean $secure = null)
    {
        $themes = THEMES_NAME . DIRECTORY_SEPARATOR . Config::get('app.themes_back');
        return app('url')->asset($themes . $path, $secure);
    }
}
if (!function_exists('frontView')) {
    function frontView(string $view, array $data = [], array $mergeData = [])
    {
        $factory = app('Illuminate\Contracts\View\Factory');
        if (func_num_args() === 0) {
            return $factory;
        }
        $themes = THEMES_NAME . '.' . Config::get('app.themes');
        return $factory->make($themes . '.' . $view, $data, $mergeData);
    }
}
if (!function_exists('backView')) {
    function backView(string $view, array $data = [], array $mergeData = [])
    {
        $factory = app('Illuminate\Contracts\View\Factory');
        if (func_num_args() === 0) {
            return $factory;
        }
        $themes = THEMES_NAME_BACK;
        return $factory->make($themes . '.' . $view, $data, $mergeData);
    }
}
if (!function_exists('callMock')) {
    function callMock(string $serverUrl, array $params)
    {
        try {
            $url = 'http://rap.taobao.org/mockjsdata/15778' . $serverUrl;
            $client = new GuzzleHttp\Client();
            $response = $client->request('get', $url, ['query' => $params]);
            $result = $response->getBody();
            if (empty($result)) {
                return json_decode('{"code":"500","status":"failed","msg":"api数据异常" }');
            }
            return json_decode($result);
        } catch (\Exception $e) {
            $error = [
                'code' => 500,
                'status' => 'failed',
                'msg' => $e->getMessage()
            ];
            $va = json_decode(json_encode($error));
            return $va;
        }
    }
}
if (!function_exists('callThirdApi')) {
    function callThirdApi(string $url, array $params = [])
    {
        try {
            $client = new GuzzleHttp\Client();
            $response = $client->request('get', $url, ['query' => $params]);
            $result = $response->getBody();
            if (empty($result)) {
                return json_decode('{"code":"500","status":"failed","msg":"api数据异常" }');
            }
            return json_decode($result);
        } catch (\Exception $e) {
            $error = [
                'code' => 500,
                'status' => 'failed',
                'msg' => $e->getMessage()
            ];
            $va = json_decode(json_encode($error));
            return $va;
        }
    }
}
if (!function_exists('debug')) {
    function debug(string $msg)
    {
        Storage::disk('local')->put('debug' . date('Y-m-d') . '.log', $msg);
    }
}
if (!function_exists('pagination')) {
    function pagination(string $url, int $page, int $total): string
    {
        $html = '<nav id="pagenavi">';
        if ($page === $total) {
            if ($page !== 1) {
                $html .= '<a href="' . $url . '/' . ($page - 1) . '" class="prev">Prev</a>';
            }
        } else {
            if ($page === 1) {
                $html .= '<a href="' . $url . '/' . ($page + 1) . '" class="next">Next</a>';
            } else {
                $html .= '<a href="' . $url . '/' . ($page - 1) . '" class="prev">Prev</a>
            <a href="' . $url . '/' . ($page + 1) . '" class="next">Next</a>';
            }
        }
        $html .= '</nav>';
        return $html;
    }
}