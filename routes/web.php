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

Route::get('/', function () {
    return view('welcome');
});


Route::namespace('Admin')->prefix('/admin')->group(function (){
    Route::get('/','AdminController@index');
    Route::get('/console','AdminController@console');  // 控制台

    Route::get('/adminlist','AdminController@adminList');  // 管理员列表页面
    Route::get('/jsonAdminlist','AdminController@jsonAdminlist');  // 管理员列表json
    Route::get('/adminAdd','AdminController@adminAdd');  // 管理员添加页面
    Route::post('/adminAdd','AdminController@adminAdd');  // 管理员添加

    Route::get('/article','ArticleController@index');  // 文章管理页面
});