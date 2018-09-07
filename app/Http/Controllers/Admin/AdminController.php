<?php

namespace App\Http\Controllers\Admin;


use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        return view('backend.home.console');
    }

    public function adminList()
    {
        return view('backend.admin.adminlist');
    }

    // json格式admin列表  get请求
    public function jsonAdminlist(Request $request)
    {
        $param = $request->all();
        $count = Admin::where('name', 'like', isset($param['loginname']) ? "%{$param['loginname']}%" : "%%")->count();
        $data = Admin::where('name', 'like', isset($param['loginname']) ? "%{$param['loginname']}%" : "%%")->paginate($param['limit']);

        return $this->toJson(0, '成功', $data, $count);
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
            $admin->password = bcrypt($request->input('password'));
            $admin->email = $request->input('email');
            $result = $admin->save();
            if ($result) {
                return $this->toJson(1, '新增成功');
            } else {
                return $this->toJson(0, '系统错误');
            }
        }

        return view('backend.admin.adminadd');
    }


    public function adminUpdate(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            var_dump(1);
            exit;
        }
        $admin = DB::table('ck_admin')->where('id',$id)->first();
        return view('backend.admin.adminupdate',['admin' => $admin]);
    }
}
