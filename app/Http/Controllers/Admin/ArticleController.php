<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //

    public function index()
    {
        return view('backend.article.article');
    }

    public function articleAdd()
    {
        return view('backend.article.article_add');
    }
}
