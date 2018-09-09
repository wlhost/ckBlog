<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Base
{
    //

    protected  $table = 'ck_articles';



    // 可以访问到拥有此分类的文章
    public function  category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
