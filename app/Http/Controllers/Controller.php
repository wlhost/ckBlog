<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * json格式返回
     * $code 正常返回1，错误返回0
     */
    public function toJson($code,$msg='',$data=[])
    {
        $count = count($data);
        $res = [
            'code' => $code,
            'msg' => $msg,
            'count' => $count,
            'data' => $data
        ];
        return $res;
    }

}
