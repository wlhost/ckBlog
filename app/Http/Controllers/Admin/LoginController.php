<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\Admin\login;
use App\Models\Admin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{

    //
    public function index()
    {
        return view('backend.login.login');
    }

    public function login(login $request)
    {
        // 排除_token  // 此处已经验证
        $data = $request->except('_token');

        // 查找数据验证账户
        $res = DB::table('ck_admin')->where('name',$data['username'])->first();
        if (!$res) {
            return $this->toJson(0);
        }
        // hash验证
        if (Hash::check($data['password'],$res->password))
        {
            $data = [
                'admin' => [
                    'id' => $res->id,
                    'name' => $res->name,
                    'avatar' => $res->avatar,
                    'email' => $res->email,
                    'is_login' => 1
                ]
            ];
            session($data);
            return response()->json([
                'code' => 0,
                'msg' => '登录成功'
            ]);
        }else {
            return response()->json([
                'code' => -1,
                'msg' => '账号或密码不正确'
            ]);
        }
    }

}
