<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('ck_admin')->insert([
           'name' => 'admin',
           'nickname' => 'admin',
           'password' => bcrypt('admin'),
            'avatar' => '',
            'email' => '631282467@qq.com',
        ]);
    }
}
