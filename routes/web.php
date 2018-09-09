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

    /********* 后台管理员 ***********/
    Route::group(['prefix' => 'admin'],function() {
        Route::post('upload','AdminController@upload');  //上传
        Route::get('list', 'AdminController@list');  // 文章管理页面
        Route::get('jsonAdmin', 'AdminController@jsonAdmin');  // 文章管理页面
        Route::get('store', 'AdminController@store');  // 文章添加页面
        Route::post('store', 'AdminController@store');  // 文章添加逻辑
        Route::get('update/{id}', 'AdminController@update');  // 文章添加逻辑
        Route::post('update', 'AdminController@update');  // 文章添加逻辑
        Route::get('delete', 'AdminController@delete');  // 文章添加逻辑
    });

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

    /********* 分类 ***********/
    Route::group(['prefix' => 'category'],function() {
        Route::get('index', 'CategoryController@index');  // 文章管理页面
        Route::get('jsonCategory', 'CategoryController@jsonCategory');  // 文章管理页面
        Route::get('store', 'CategoryController@store');  // 文章添加页面
        Route::post('store', 'CategoryController@store');  // 文章添加逻辑
        Route::get('update/{id}', 'CategoryController@update');  // 文章添加逻辑
        Route::post('update', 'CategoryController@update');  // 文章添加逻辑
        Route::get('delete', 'CategoryController@delete');  // 文章添加逻辑
    });

    /********* 标签 ***********/
    Route::group(['prefix' => 'tag'],function() {
        Route::get('index', 'TagController@index');  // 标签管理页面
        Route::get('jsonTag', 'TagController@jsonCategory');  // 标签管理页面
        Route::get('store', 'TagController@store');  //标签添加页面
        Route::post('store', 'TagController@store');  // 标签添加逻辑
        Route::get('update/{id}', 'TagController@update');  // 标签添加逻辑
        Route::post('update', 'TagController@update');  // 标签添加逻辑
        Route::get('delete', 'TagController@delete');  // 标签添加逻辑
    });

    /********* 评论 ***********/
    Route::get('comment', 'CommentController@index');
    Route::get('commentAdd', 'CommentController@commentAdd');
    Route::post('commentAdd', 'CommentController@commentAdd');



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