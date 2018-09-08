<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\log;


class CategoryController extends Controller
{
    //

    // 分类页面
    public function index()
    {
        return view('backend.category.index');
    }
    // 分类页面数据
    public function jsonCategory(Request $request)
    {
        $param = $request->all();
        $category = Category::select()->where(function($query) use ($param) {
            if (isset($param['name']) && $param['name'] != '') {
                $query->where('name','like',"%{$param['name']}%");
            }
        });
        $count = $category->count();
        $data = $category->paginate($param['limit']);
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
            Category::create([
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
        return view('backend.category.store');
    }


    public function update(Request $request,$id=0) {

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255',
                'url' => 'required|max:255',
                'sort' => 'required|unique:ck_navs|integer|between:0,255',
            ]);
            Category::where('id',$request['id'])->update([
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

        $data = Category::find($id)->toArray();
        return view('backend.category.update',['nav' => $data]);
    }


    public function delete(Request $request){
        if (is_array($request['id'])) {
            foreach ($request['id'] as $item) {
                Category::where('id',$item)->delete();
            }
        }else {
            Category::where('id',$request['id'])->delete();
        }
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => 0,
            'data' =>0,
        ]);
    }

}
