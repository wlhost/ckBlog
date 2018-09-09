<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TagController extends Controller
{
    //

    // 分类页面
    public function index()
    {
        return view('backend.tag.index');
    }
    // 分类页面数据
    public function jsonCategory(Request $request)
    {
        $param = $request->all();
        $tag = Tag::select()->where(function($query) use ($param) {
            if (isset($param['name']) && $param['name'] != '') {
                $query->where('name','like',"%{$param['name']}%");
            }
        });
        $count = $tag->count();
        $data = $tag->paginate($param['limit']);
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
                'name' => 'required|unique:ck_tags|max:255',
            ]);
            Tag::create([
                'name' => $request['name'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }
        return view('backend.tag.store');
    }


    public function update(Request $request,$id=0) {

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255',
            ]);
            Tag::where('id',$request['id'])->update([
                'name' => $request['name'],
            ]);
            return response()->json([
                'code' => 0,
                'msg' => 'SUCCESS',
                'count' => 0,
                'data' =>0,
            ]);
        }

        $data = Tag::find($id)->toArray();
        return view('backend.tag.update',['tag' => $data]);
    }


    public function delete(Request $request){
        if (is_array($request['id'])) {
            foreach ($request['id'] as $item) {
                Tag::where('id',$item)->delete();
            }
        }else {
            Tag::where('id',$request['id'])->delete();
        }
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => 0,
            'data' =>0,
        ]);
    }

}
