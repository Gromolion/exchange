<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ResetController extends Controller
{
    public function reset()
    {
        Artisan::call('migrate:fresh --seed');

        session()->flash('result', 'Сайт был успешно сброшен!');
        return redirect()->route('index');
    }
}
