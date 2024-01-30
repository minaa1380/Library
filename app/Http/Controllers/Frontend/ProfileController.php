<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            $user->update($request->except(['token', 'confirmPassword', 'password', 'pic']));
            Session::put('status', ['status' => 200, 'message' => 'پروفایل باموفقیت ویرایش شد.']);
        } catch (QueryException $exception) {
            Session::put('status', ['status' => 201, 'message' => 'خطا در ویرایش پروفایل ، مجددا تلاش کنید']);
        }
        return redirect()->back();
    }
}
