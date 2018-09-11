<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Base
{
    //

    protected  $table = 'ck_articles';


    protected $fillable = ['category_id','title','author','markdown','html','description','keywords','cover','is_top'];

    // 可以访问到拥有此分类的文章
    public function  category()
    {
        return $this->belongsTo('App\Models\Category');
    }


    public function tag()
    {
        return $this->hasMany('App\Models\Tag');
    }

}
