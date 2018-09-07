<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\log;


class NavController extends Controller
{
    //

    // 分类页面
    public function index()
    {
        return view('backend.nav.index');
    }
    // 分类页面数据
    public function jsonNav(Request $request)
    {
        $param = $request->all();
        $nav = Nav::select()->where(function($query) use ($param) {
            if (isset($param['name']) && $param['name'] != '') {
                $query->where('name','like',"%{$param['name']}%");
            }
        });
        $count = $nav->count();
        $data = $nav->paginate($param['limit']);
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
                'name' => 'required|unique:ck_navs|max:255',
                'url' => 'required|max:255',
                'sort' => 'required|unique:ck_navs|integer|between:0,255',
            ]);
            Nav::create([
                'name' => $request['name'],
                'url' => $request['url'],
                'sort' => $request['sort'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }
        return view('backend.nav.store');
    }


    public function update(Request $request,$id=0) {

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255',
                'url' => 'required|max:255',
                'sort' => 'required|unique:ck_navs|integer|between:0,255',
            ]);
            Nav::where('id',$request['id'])->update([
                'name' => $request['name'],
                'url' => $request['url'],
                'sort' => $request['sort'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }

        $data = Nav::find($id)->toArray();
        return view('backend.nav.update',['nav' => $data]);
    }


    public function delete(Request $request){
        if (is_array($request['id'])) {
            foreach ($request['id'] as $item) {
                Nav::where('id',$item)->delete();
            }
        }else {
            Nav::where('id',$request['id'])->delete();
        }
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => 0,
            'data' =>0,
        ]);
    }

}
