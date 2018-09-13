<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Base
{
    //
    protected  $table= 'ck_tags';


    protected $fillable = ['name'];


    /**
     * 关联文章表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'ck_article_tags');
    }

}
