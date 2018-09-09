<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
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
        $count = $articles->count();
        $data = $articles->paginate($param['limit']);
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => $count,
            'data' =>$data,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:ck_categories|max:255',
                'pid' => 'required|integer|max:255',
                'sort' => 'required|unique:ck_categories|integer|between:0,255',
                'keywords' => 'required',
                'description' => 'required',
            ]);
            Article::create([
                'name' => $request['name'],
                'pid' => $request['pid'],
                'sort' => $request['sort'],
                'keywords' => $request['keywords'],
                'description' => $request['description'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }

        $category = Category::where('pid',0)->get();
        return view('backend.article.store',['category'=>$category]);
    }


    public function update(Request $request,$id=0) {

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255',
                'pid' => 'required|integer|max:255',
                'sort' => 'required|unique:ck_categories|integer|between:0,255',
                'keywords' => 'required',
                'description' => 'required',
            ]);
            Article::where('id',$request['id'])->update([
                'name' => $request['name'],
                'pid' => $request['pid'],
                'sort' => $request['sort'],
                'keywords' => $request['keywords'],
                'description' => $request['description'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }

        $article = Article::find($id)->toArray();
        return view('backend.article.update',['article' => $article]);
    }


    public function delete(Request $request){
        if (is_array($request['id'])) {
            foreach ($request['id'] as $item) {
                Article::where('id',$item)->delete();
            }
        }else {
            Article::where('id',$request['id'])->delete();
        }
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => 0,
            'data' =>0,
        ]);
    }

}
