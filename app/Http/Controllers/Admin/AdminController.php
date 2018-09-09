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

    // 分类页面
    public function list()
    {
        return view('backend.admin.index');
    }
    // 分类页面数据
    public function jsonAdmin(Request $request)
    {
        $param = $request->all();
        $admin = Admin::select()->where(function($query) use ($param) {
            if (isset($param['name']) && $param['name'] != '') {
                $query->where('name','like',"%{$param['name']}%");
            }
        });
        $count = $admin->count();
        $data = $admin->paginate($param['limit']);
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => $count,
            'data' =>$data,
        ]);
    }


    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:ck_admin|max:255',
                'nickname' => 'required|max:255',
                'password' => 'required',
                'email' => 'required',
            ]);
            Admin::create([
                'name' => $request['name'],
                'nickname' => $request['nickname'],
                'password' => bcrypt($request['password']),
                'avatar' => $request['avatar'],
                'email' => $request['email'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }
        return view('backend.admin.store');
    }


    public function update(Request $request,$id=0) {

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255',
                'nickname' => 'required|max:255',
                'avatar' => 'required',
                'email' => 'required',
            ]);
            $up = [
                'name' => $request['name'],
                'nickname' => $request['nickname'],
                'password' => bcrypt($request['password']),
                'avatar' => $request['avatar'],
                'email' => $request['email'],
            ];
            if ($request['password'] == '') {
                unset($up['password']);
            }
            Admin::where('id',$request['id'])->update($up);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }

        $data = Admin::find($id)->toArray();
        return view('backend.admin.update',['admin' => $data]);
    }


    public function delete(Request $request){
        if (is_array($request['id'])) {
            foreach ($request['id'] as $item) {
                Admin::where('id',$item)->delete();
            }
        }else {
            Admin::where('id',$request['id'])->delete();
        }
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => 0,
            'data' =>0,
        ]);
    }

    // 上传图片
    public function upload(Request $request){
        if(!$request->hasFile('file')){
            $request->session()->flash('error_msg','文件不存在');
            return back();
        }
        $img = $request->file('file');
        // 获取后缀名
        $ext = $img->extension();
        // 新文件名
        $saveName =time().rand().".".$ext;
        // 存储文件 已经不使用 move 这种方式
        // $img->move('./uploads/'.date('Ymd'),$saveName);
        // 使用 store 存储文件
        $path = $img->store(date('Ymd'));
        return response()->json([
            'code' => 0,
            'url'=>'uploads/'.$path
        ]);
    }
}
