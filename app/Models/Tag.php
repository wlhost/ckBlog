<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Base
{
    //
    protected  $table= 'ck_tags';


    protected $fillable = ['name'];
}
