<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Back\AdminController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Back'], function () {
    /**React测试*/
    Route::get('/insert', 'ReactDemoController@insert');
    Route::get('/fetchReactDemo', 'ReactDemoController@fetch');
    Route::post('/delReactDemo', 'ReactDemoController@del');
    Route::post('/editReactDemo/{id}', 'ReactDemoController@edit');
    Route::post('/createReactDemo', 'ReactDemoController@create');
    /**第三方登陆*/
    Route::post('/login', 'AdminController@loginSubmit');
    Route::get('/info', 'AdminController@info');
    /**系统运行信息等*/
    Route::get('/weather', 'DashboardController@weather');
    Route::get('/os', 'DashboardController@os');
    Route::get('/card', 'DashboardController@card');
    Route::get('/browser', 'DashboardController@browser');
    Route::get('/connecting-info', 'DashboardController@connectingInfo');
    Route::get('/connecting-detail', 'DashboardController@connectDetail');

    /**文章*/
    Route::get('/article/lists', 'ArticleController@lists');
    Route::get('/article/create', 'ArticleController@create');

});

