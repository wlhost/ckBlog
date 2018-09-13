<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTags extends Base
{
    //

    protected $table = "ck_article_tags";
    protected $fillable = ['article_id', 'tag_id'];



}
