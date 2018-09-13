<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebSiteController extends Controller
{
    //

    public function index()
    {
        $config = Config::all()->toArray();
        $config = Config::configToKV($config);
        return view('backend.website.index',['config' => $config]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'logo' => 'required',
            'sitename' => 'required',
            'sitename2' => 'required',
            'connection' => 'required',
            'keywords' => 'required',
            'description' => 'required',
            'copyright' => 'required',
        ]);

        Config::store($request->all());
        return response()->json([
            'code' => 0,
            'msg' => 'SUCCESS',
            'count' => 0,
            'data' =>0,
        ]);


    }

}
