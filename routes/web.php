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



Route::get('/', '\App\Http\Controllers\Home\IndexController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin.auth']], function () {
    Route::get('/', 'AdminController@index');
    Route::get('console', 'AdminController@console');  // 控制台

    /********* 后台管理员 ***********/
    Route::group(['prefix' => 'admin'],function() {
        Route::post('upload','AdminController@upload');
        Route::post('editorMd','AdminController@editorMd');
        Route::get('list', 'AdminController@list');
        Route::get('jsonAdmin', 'AdminController@jsonAdmin');
        Route::get('store', 'AdminController@store');
        Route::post('store', 'AdminController@store');
        Route::get('update/{id}', 'AdminController@update');
        Route::post('update', 'AdminController@update');
        Route::get('delete', 'AdminController@delete');
    });

    /******* 文章 ********/
    Route::group(['prefix' => 'article'],function() {
        Route::get('index', 'ArticleController@index');
        Route::get('jsonArticle', 'ArticleController@jsonArticle');
        Route::get('store', 'ArticleController@store');
        Route::post('store', 'ArticleController@store');
        Route::get('update/{id}', 'ArticleController@update');
        Route::post('update', 'ArticleController@update');
        Route::get('delete', 'ArticleController@delete');

    });

    /********* 导航 ***********/
    Route::group(['prefix' => 'nav'],function() {
        Route::get('index', 'NavController@index');
        Route::get('jsonNav', 'NavController@jsonNav');
        Route::get('store', 'NavController@store');
        Route::post('store', 'NavController@store');
        Route::get('update/{id}', 'NavController@update');
        Route::post('update', 'NavController@update');
        Route::get('delete', 'NavController@delete');
    });

    /********* 分类 ***********/
    Route::group(['prefix' => 'category'],function() {
        Route::get('index', 'CategoryController@index');
        Route::get('jsonCategory', 'CategoryController@jsonCategory');
        Route::get('store', 'CategoryController@store');
        Route::post('store', 'CategoryController@store');
        Route::get('update/{id}', 'CategoryController@update');
        Route::post('update', 'CategoryController@update');
        Route::get('delete', 'CategoryController@delete');
    });

    /********* 标签 ***********/
    Route::group(['prefix' => 'tag'],function() {
        Route::get('index', 'TagController@index');
        Route::get('jsonTag', 'TagController@jsonTag');
        Route::get('store', 'TagController@store');
        Route::post('store', 'TagController@store');
        Route::get('update/{id}', 'TagController@update');
        Route::post('update', 'TagController@update');
        Route::get('delete', 'TagController@delete');
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