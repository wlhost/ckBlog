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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin.auth']], function () {
    Route::get('/', 'AdminController@index');
    Route::get('console', 'AdminController@console');  // 控制台

    Route::get('adminlist', 'AdminController@adminList');  // 管理员列表页面
    Route::get('jsonAdminlist', 'AdminController@jsonAdminlist');  // 管理员列表json
    Route::get('adminAdd', 'AdminController@adminAdd');  // 管理员添加页面
    Route::post('adminAdd', 'AdminController@adminAdd');  // 管理员添加

    /******* 文章 ********/
    Route::get('articleAdd', 'ArticleController@articleAdd');  // 发布文章页面
    Route::get('article', 'ArticleController@index');  // 文章管理页面
    /********* 分类 ***********/
    Route::get('category', 'CategoryController@index');
    Route::get('catAdd', 'CategoryController@catAdd');
    Route::post('catAdd', 'CategoryController@catAdd');
    /********* 评论 ***********/
    Route::get('comment', 'CommentController@index');
    Route::get('commentAdd', 'CommentController@commentAdd');
    Route::post('commentAdd', 'CommentController@commentAdd');
    /********* 标签 ***********/
    Route::get('tag', 'TagController@index');
    Route::get('tagAdd', 'TagController@tagAdd');
    Route::post('tagAdd', 'TagController@tagAdd');
    /********* 导航 ***********/
    Route::get('nav', 'NavController@index');
    Route::get('navAdd', 'NavController@navAdd');
    Route::post('navAdd', 'NavController@navAdd');

});


// 后台登录页面
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // 登录页面
    Route::get('login', 'LoginController@index')->middleware('admin.login');
    // 登录操作
    Route::post('login', 'LoginController@login');
    // 退出
    Route::get('logout', 'LoginController@logout');

});