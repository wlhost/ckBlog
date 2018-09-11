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
        $article = DB::select('select a.id,a.title,a.author,a.html,a.description,a.keywords,a.cover,a.is_top,b.`name` from ck_articles a, ck_categories b WHERE a.category_id = b.id');

        dump($article);
        exit;
        $category = Category::all();
        return view('home.index',['article' => $article]);
    }
}
