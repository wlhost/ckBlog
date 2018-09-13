<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\ArticleTags;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    //

    public function index(Request $request)
    {
        $tag = Tag::all();
        return view('backend.article.index',['tag' => $tag]);
    }

    // json返回文章数据
    public function jsonArticle(Request $request)
    {
        $param = $request->all();
        $articles = Article::select()->where(function ($query) use ($param) {
            if (isset($param['id']) && $param['id'] != '') {
                $query->where('id', $param['id']);
            }
            if (isset($param['author']) && $param['author'] != '') {
                $query->where('author', 'like', "%{$param['author']}%");
            }
            if (isset($param['title']) && $param['title'] != '') {
                $query->where('title', 'like', "%{$param['title']}%");
            }
        });
        $count = $articles->count();
        $data = $articles->paginate($param['limit']);

        for ($i=0;$i<$count;$i++) {
            $data[$i]['category_id'] = Category::where('id',$data[$i]['category_id'])->first()->toArray()['name'];

            if ($data[$i]['is_top'] ==0) {
                $data[$i]['is_top'] = '未置顶';
            }else {
                $data[$i]['is_top'] = '置顶';
            }
        }
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => $count,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|unique:ck_articles|max:255',
                'author' => 'required|max:255',
                'category_id' => 'required|integer|max:255',
                'tags' => 'required|max:255',
                'content' => 'required',
                'keywords' => 'required',
            ]);

            if ($request['description'] == '') {
                $description = preg_replace(array('/[~*>#-]*/', '/!?\[.*\]\(.*\)/', '/\[.*\]/'), '', $request['content']);
                $request['description'] = $this->re_substr($description, 0, 200, true);
            }

            if (isset($request['is_top']) && $request['is_top'] == 'on') {
                $top = 1;
            } else {
                $top = 0;
            }
            if (empty($request['cover'])) {
                $request['cover'] = Article::getCover($request['content']);
            }
            $article = Article::create([
                'category_id' => $request['category_id'],
                'title' => $request['title'],
                'author' => $request['author'],
                'markdown' => $request['content'],
                'html' => $request['article-html-code'],
                'keywords' => $request['keywords'],
                'description' => $request['description'],
                'cover' => $request['cover'],
                'is_top' => $top,
            ]);
            // 插入标签
            $tags = explode(',',$request['tags']);
            for ($i=0;$i<count($tags);$i++) {
                ArticleTags::create([
                    'article_id' => $article->id,
                    'tag_id' => $tags[$i]
                ]);
            }
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' => 0,
            ]);
        }

        $category = Category::all();
        $tags = Tag::all();
        return view('backend.article.store', ['category' => $category, 'tag' => $tags]);
    }

    public  function re_substr($str, $start = 0, $length, $suffix = true, $charset = "utf-8") {
        $slice = mb_substr($str, $start, $length, $charset);
        $omit = mb_strlen($str) >= $length ? '...' : '';
        return $suffix ? $slice.$omit : $slice;
    }

    public function update(Request $request, $id = 0)
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:255',
                'author' => 'required|max:255',
                'category_id' => 'required|integer|max:255',
                'tags' => 'required|max:255',
                'content' => 'required',
                'keywords' => 'required',
            ]);
            if ($request['description'] == '') {
                $description = preg_replace(array('/[~*>#-]*/', '/!?\[.*\]\(.*\)/', '/\[.*\]/'), '', $request['content']);
                $request['description'] = $this->re_substr($description, 0, 200, true);
            }

            if (isset($request['is_top']) && $request['is_top'] == 'on') {
                $top = 1;
            } else {
                $top = 0;
            }
            Article::where('id', $request['id'])->update([
                'category_id' => $request['category_id'],
                'title' => $request['title'],
                'author' => $request['author'],
                'markdown' => $request['content'],
                'html' => $request['article-html-code'],
                'keywords' => $request['keywords'],
                'description' => $request['description'],
                'cover' => $request['cover'],
                'is_top' => $top,
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' => 0,
            ]);
        }

        $article = Article::where('id',$id)->first();
        $category = Category::all();
        $tags = Tag::all();
        $selectTag = ArticleTags::where('article_id',$id)->get()->toArray();
        foreach ($selectTag as $v){
            $ids[] = $v['tag_id'];
        }
        $selectTag = implode(',',$ids);
        return view('backend.article.update', ['category' => $category, 'tag' => $tags , 'article' => $article,'seletTag' => $selectTag]);
    }


    public function delete(Request $request)
    {
        if (is_array($request['id'])) {
            foreach ($request['id'] as $item) {
                Article::where('id', $item)->delete();
            }
        } else {
            Article::where('id', $request['id'])->delete();
        }
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => 0,
            'data' => 0,
        ]);
    }

}
