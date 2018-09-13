<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\ArticleTags;
use App\Models\Category;
use App\Models\Config;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    protected $category = [];
    protected $config = [];
    public function __construct()
    {
        $res = Category::orderBy('sort','ASC')->get()->toArray();
        $this->category = \IchenkunFun::unlimitedForLayer($res);
        $result = Config::all()->toArray();
        $this->config = Config::configToKV($result);
    }

    //
    public function index()
    {
        $article = Article::where('is_top',0)->with(['category'])->orderBy('created_at','DESC')->limit(10)->get();
        $top = Article::where('is_top' ,1)->get();
        $hotArticle = Article::orderBy('click','DESC')->limit(7)->get();
        return view('home.index',['article' => $article,'category' => $this->category,'hot'=>$hotArticle,'top' => $top,'config'=> $this->config]);
    }

    public function article(Request $request,$id)
    {
        $article = Article::with(['category', 'tags'])->find($id);
        // 同一个用户访问同一篇文章每天只增加1个访问量  使用 ip+id 作为 key 判别
        $ipAndId = 'articleRequestList'.$request->ip().':'.$id;
        if (!Cache::has($ipAndId)) {
            cache([$ipAndId => ''], 1440);
            // 文章点击量+1
            $article->increment('click');
        }

        $tag = DB::select('select  b.name FROM ck_article_tags a, ck_tags b where a.tag_id = b.id and a.article_id=?',[$id]);

        // 获取上一篇
        $prev = Article::select('id', 'title')
            ->orderBy('created_at', 'asc')
            ->where('id', '>', $id)
            ->limit(1)
            ->first();

        // 获取下一篇
        $next = Article::select('id', 'title')
            ->orderBy('created_at', 'desc')
            ->where('id', '<', $id)
            ->limit(1)
            ->first();

        return view('home.article',[
            'article' => $article,
            'category' => $this->category,
            'tag'=>$tag,
            'prev' => $prev,
            'next' => $next,
            'config'=> $this->config
        ]);
    }


    public function category(Request $request,$alias)
    {
        $category = Category::where('alias',$alias)->first();
        $articles = Article::where('category_id',$category['id'])->orderBy('created_at','DESC')->paginate(4);

        return view('home.category',[
            'category' => $this->category,
            'cat' => $category,
            'articles' => $articles,
            'config'=> $this->config
        ]);
    }

    public function all()
    {
        $articles = Article::orderBy('created_at','DESC')->paginate(8);
        return view('home.allArticle',[
            'category' => $this->category,
            'article' => $articles,
            'config'=> $this->config
        ]);
    }


}
