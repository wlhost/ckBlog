<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Base
{
    //

    protected  $table = 'ck_articles';


    protected $fillable = ['category_id','title','author','markdown','html','description','keywords','cover','is_top'];

    /**
     * 关联文章表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 关联标签表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ck_article_tags');
    }


    public static function getCover($content, $except = [])
    {
        // 获取文章中的全部图片
        preg_match_all('/!\[.*?\]\((\S*(?<=png|gif|jpg|jpeg)).*?\)/i', $content, $images);
        if (empty($images[1])) {
            $cover = '/home/images/blog.jpg';
        }
        return $cover;
    }

}
