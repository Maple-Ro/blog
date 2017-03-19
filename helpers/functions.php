<?php
/**
 * Description:  一些有用的函数
 * User: Endless
 * Date: 2017/3/19
 * Time: 19:40
 */
if (function_exists('homeAssets')) {
    function homeAssets(string $path, boolean $secure = null)
    {
        $themes = THEMES_NAME . DIRECTORY_SEPARATOR . Config::get('app.themes');
        return app('url')->asset($themes . $path, $secure);
    }
}
if (function_exists('frontView')) {
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