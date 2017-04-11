<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'front'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/detail/{id}', 'IndexController@detail');
    Route::get('/test', 'IndexController@test');
    Route::get('/cls', function () {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        return "cache clear success";
    });
    Route::get('/add', 'LogController@add');
    Route::get('/sum', 'LogController@sum');
});

//后台
Route::group(['namespace' => 'back', 'prefix' => env('APP_BACK')], function () {
    Route::get('/', 'IndexController@index');
//    Route::get('/insert', 'IndexController@insert');
    Route::get('/insert2', 'IndexController@insert2');
    Route::get('/add', 'ArticleController@add');
    Route::get('/del/{id}', 'ArticleController@delOne');
    Route::get('/fetch/{id}', 'ArticleController@one');
});
