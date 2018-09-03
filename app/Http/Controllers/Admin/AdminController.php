<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    // 后台首页
    public function index()
    {
        return view('backend.index');
    }


    // 后台首页控制台
    public function console()
    {
        return view('backend.page.console');
    }


    public function adminList()
    {
        return view('backend.page.adminlist');
    }

    // json格式admin列表
    public function jsonAdminlist()
    {
        $data = Admin::all();
        $count = count($data);
        return $this->toJson(0,$data,$count);
    }

    // 添加管理员页面
    public function adminAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $validateData = $request->validate([
               'name' => 'required',
               'nickname' => 'required',
               'password' => 'required',
               'email' => 'required',
            ]);
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->nickname = $request->input('nickname');
            $admin->password = $this->md5Password($request->input('password'));
            $admin->email = $request->input('email');
            $admin->last_login_ip = $request->getClientIp();
            $admin->last_login_time = date('Y-m-d H:i:s',time());
            $result = $admin->save();
            if ($result) {
                return $this->toJson(0,'','','新增成功');
            }else {
                return $this->toJson(-1,'','','系统错误');
            }
        }

        return view('backend.page.adminadd');
    }

}
