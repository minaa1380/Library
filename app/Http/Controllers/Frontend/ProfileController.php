<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.profile');
    }

    public function update(Request $request)
    {
        try {
            $user = User::find(Auth::id());
            $user->update($request->except('token'));
            return true;
        } catch (QueryException $exception)  {
            return false;
        }
    }
}
