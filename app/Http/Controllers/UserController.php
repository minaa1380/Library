<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('frontend.index', compact('config'));
    }

    public function check()
    {
        if (Auth::user()->user_type == 0)
            return redirect(route('users.index'));
        return redirect(route('panel'));
    }
}
