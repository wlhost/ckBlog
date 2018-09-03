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
     */
    public function toJson($code,$data,$count=0,$msg='')
    {
        $res = [
            'code' => $code,
            'msg' => $msg,
            'count' => $count,
            'data' => $data
        ];
        return $res;
    }

    /**
     * 加密密码
     * @param $password
     */
    public function md5Password($password,$prefix="ck&%157!%.") {
        return sha1(md5($prefix . $password) . md5($password));
    }
}
