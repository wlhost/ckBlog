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
    Route::get('adminUpdate/{id}','AdminController@adminUpdate');   //管理员修改
    Route::post('adminUpdate','AdminController@adminUpdate');   //管理员修改
    Route::post('adminDel','AdminController@adminDel');   //管理员修改

    /******* 文章 ********/
    Route::group(['prefix' => 'article'],function() {
        Route::get('index', 'ArticleController@index');  // 文章管理页面
        Route::get('jsonArticle', 'ArticleController@jsonArticle');  // 文章管理页面
        Route::get('store', 'ArticleController@store');  // 文章添加页面
        Route::post('store', 'ArticleController@store');  // 文章添加逻辑

    });

    /********* 导航 ***********/
    Route::group(['prefix' => 'nav'],function() {
        Route::get('index', 'NavController@index');  // 文章管理页面
        Route::get('jsonNav', 'NavController@jsonNav');  // 文章管理页面
        Route::get('store', 'NavController@store');  // 文章添加页面
        Route::post('store', 'NavController@store');  // 文章添加逻辑
        Route::get('update/{id}', 'NavController@update');  // 文章添加逻辑
        Route::post('update', 'NavController@update');  // 文章添加逻辑
        Route::get('delete', 'NavController@delete');  // 文章添加逻辑

    });

    Route::group(['prefix' => 'category'],function() {
        Route::get('index', 'CategoryController@index');  // 文章管理页面
        Route::get('jsonCategory', 'CategoryController@jsonCategory');  // 文章管理页面
        Route::get('store', 'CategoryController@store');  // 文章添加页面
        Route::post('store', 'CategoryController@store');  // 文章添加逻辑
        Route::get('update/{id}', 'CategoryController@update');  // 文章添加逻辑
        Route::post('update', 'CategoryController@update');  // 文章添加逻辑
        Route::get('delete', 'CategoryController@delete');  // 文章添加逻辑

    });


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