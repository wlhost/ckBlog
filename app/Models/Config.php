<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    protected $table="ck_configs";




    public static function configToKV($config) {
        $data = [];
        foreach ($config as $v) {
            $data[$v['name']] = $v['value'];
        }

        return $data;
    }

    public static function store($config){
        while (list($key, $val) = each($config))
        {
            self::where('name', $key)->update([
                'value' => $val
            ]);
        }
    }
}
