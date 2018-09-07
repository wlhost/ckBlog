<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nav extends Base
{
    //

    protected  $table = "ck_navs";

    protected $fillable = ['name','url','sort'];
}
