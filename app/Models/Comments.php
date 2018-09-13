<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Base
{
    //

    /**
     * 关联文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class)->withDefault();
    }
}
