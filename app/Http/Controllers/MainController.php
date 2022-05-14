<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function sells()
    {
        return view('sells');
    }

    public function buys()
    {
        return view('buys');
    }

    public function obligations()
    {
        return view('obligations');
    }

    public function profile()
    {
        return view('auth.profile');
    }
}
