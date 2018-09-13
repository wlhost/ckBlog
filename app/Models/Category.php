<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Base
{
    //
    protected  $table = 'ck_categories';


    protected $fillable = ['name', 'sort','alias','pid','description','keywords'];


    /**
     * 一对多关联文章
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}
