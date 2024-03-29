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
                'name' => 'required|unique:ck_categories|max:255',
                'alias' => 'required|max:255',
                'pid' => 'required|integer|max:255',
                'sort' => 'required|unique:ck_categories|integer|between:0,255',
                'keywords' => '',
                'description' => '',
            ]);
            Category::create([
                'name' => $request['name'],
                'pid' => $request['pid'],
                'alias' => $request['alias'],
                'sort' => $request['sort'],
                'keywords' => $request['keywords'],
                'description' => $request['description'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }

        $pid = Category::where('pid',0)->get();
        return view('backend.category.store',['pid'=>$pid]);
    }


    public function update(Request $request,$id=0) {

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255',
                'pid' => 'required|integer|max:255',
                'sort' => 'required|unique:ck_categories|integer|between:0,255',
                'keywords' => 'required',
                'description' => 'required',
            ]);
            Category::where('id',$request['id'])->update([
                'name' => $request['name'],
                'pid' => $request['pid'],
                'sort' => $request['sort'],
                'keywords' => $request['keywords'],
                'description' => $request['description'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }

        $data = Category::find($id)->toArray();
        return view('backend.category.update',['category' => $data]);
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
