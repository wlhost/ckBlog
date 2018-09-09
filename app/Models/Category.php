<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Base
{
    //
    protected  $table = 'ck_categories';


    protected $fillable = ['name', 'sort','pid','description','keywords'];


    // 分类下的文章
    public function article()
    {
        return $this->hasMany('App\Models\Article','category_id');
    }
}
