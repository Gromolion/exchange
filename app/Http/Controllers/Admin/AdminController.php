<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('auth.admin.index');
    }

    public function expirate()
    {
        $expirate = DB::table('expiration')->where('id', 1)->limit(1)->update(['is_expirate' => 1]);

        Application::query()->truncate();

        return redirect()->route('index');
    }
}
