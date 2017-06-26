<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

*/
/**解决跨域问题*/
header('Access-Control-Allow-Origin:' . env('ORIGIN'));
header('Access-Control-Allow-Methods:POST, GET, OPTIONS');
header('Access-Control-Allow-Headers:Content-type, X-Authorization');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Request-Headers:Content-type, X-Authorization');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'back'], function () {
    /**React测试*/
    Route::get('/insert', 'ReactDemoController@insert');
    Route::get('/fetchReactDemo', 'ReactDemoController@fetch');
    Route::post('/delReactDemo', 'ReactDemoController@del');
    Route::post('/editReactDemo/{id}', 'ReactDemoController@edit');
    Route::post('/createReactDemo', 'ReactDemoController@create');
    /**第三方登陆*/
    Route::post('/login', 'AdminController@loginSubmit');
    Route::post('/logout', 'AdminController@logout');
    Route::get('/info', 'AdminController@info');
    /**系统运行信息等*/
    Route::get('/weather', 'DashboardController@weather');
    Route::get('/os', 'DashboardController@os');
    Route::get('/card', 'DashboardController@card');
    Route::get('/browser', 'DashboardController@browser');
    Route::get('/chart', 'DashboardController@chart');
    Route::get('/map', 'DashboardController@map');
    Route::get('/connecting-info', 'DashboardController@connectingInfo');
    Route::get('/connecting-detail', 'DashboardController@connectDetail');
    Route::get('/connecting-date', 'DashboardController@dateLog');
    Route::get('/ip-info/{ip}', 'DashboardController@eachIpLog');

    /**文章*/
    Route::get('/article/lists', 'ArticleController@lists');
    Route::get('/article/create', 'ArticleController@create');
    Route::post('/article/create', 'ArticleController@post');
    Route::post('/article/edit', 'ArticleController@post');
    Route::post('/article/del', 'ArticleController@del');
    Route::post('/article/down', 'ArticleController@down');
    Route::post('/article/up', 'ArticleController@up');
    Route::post('/article/upload', 'ArticleController@upload');
    Route::get('/article/content', 'ArticleController@content');
    Route::get('/category/list', 'CategoryController@list');
    Route::post('/category/edit', 'CategoryController@post');
    Route::post('/category/new', 'CategoryController@post');
    Route::get('/tags/list', 'TagsController@list');

});

