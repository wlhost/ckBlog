<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        $article = Article::all();
        $category = Category::all();
        return view('home.index',['article' => $article,'category' => $category]);
    }

    public function article(Request $request,$id)
    {
        $article = Article::find($id)->get();
        return view('home.article',['article' => $article]);
    }

    public function  test()
    {
        $article = Article::all();
        $category = Category::all();
        return view('home.tindex',['article' => $article,'category' => $category]);
    }

}
