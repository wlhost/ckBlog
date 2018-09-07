<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //

    public function index(Request $request)
    {
        return view('backend.article.index');
    }

    // json返回文章数据
    public function jsonArticle(Request $request) {
        $param = $request->all();
        $articles = Article::select()->where(function($query) use ($param) {
            if (isset($param['id']) && $param['id'] != '') {
                $query->where('id',$param['id']);
            }
            if (isset($param['author']) && $param['author'] != '') {
                $query->where('author','like', "%{$param['author']}%");
            }
            if (isset($param['title']) && $param['title'] != '') {
                $query->where('title','like', "%{$param['title']}%");
            }
        });
        $data = $articles->paginate($param['limit']);
        $count = $articles->count();

        return response()->json([
           'code' => 0,
           'count' => $count,
           'data' =>$data,
        ]);
    }

    public function store()
    {
        return view('backend.article.store');
    }


}
