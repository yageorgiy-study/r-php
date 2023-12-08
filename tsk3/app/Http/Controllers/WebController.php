<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{
    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function auth(Request $request)
    {
        return view('auth');
    }


    public function logs(Request $request)
    {
        $logs = File::get(storage_path().'/logs/laravel.log');
        $logs_lines = explode("\n", $logs);

        return view('admin.logs', [
            'logs' => $logs_lines
        ]);
    }

    public function phpinfo(Request $request)
    {
        return view('admin.phpinfo');
    }

    public function users(Request $request)
    {
        return view('admin.users', [
            'users' => User::all()
        ]);
    }

}
