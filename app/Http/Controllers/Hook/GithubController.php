<?php

namespace App\Http\Controllers\Hook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GithubController extends Controller
{
    //

    public function up()
    {
        $data = request()->all();
        if ($data['password'] === env('GITHUB_HOOK_PASSWORD')) {
            // 拉取并 composer update
            shell_exec('cd '.base_path().' && git pull && composer install');
        }
    }
}
