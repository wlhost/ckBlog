<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('ck_configs')->insert([
            [
                'name' => 'logo',
                'value' => "/home/images/logo.png",
            ],[
                'name' => 'sitename',
                'value' => "Ichenkun's Blog",
            ],[
                'name' => 'sitename2',
                'value' => "web开发分享第一博客",
            ],[
                'name' => 'connection',
                'value' => "-",
            ],[
                'name' => 'keywords',
                'value' => "陈坤,php,前端,IT教程",
            ],[
                'name' => 'description',
                'value' => "Ichenkun's Blog 是一个web开发分享技术博客，分享IT学习资源和教程供大家免费学习",
            ],[
                'name' => 'copyright',
                'value' => "Ichenkun's Blog 是一个web开发分享技术博客，分享IT学习资源和教程供大家免费学习",
            ]
        ]);
    }

     public function down()
     {
         DB::table('ck_configs')->delete();
     }
}
