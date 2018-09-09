<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Base
{

    // 指定数据表
    protected  $table = "ck_admin";

    protected $fillable = ['name','nickname','password','avatar','email'];


}
