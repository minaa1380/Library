<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'family' => 'required|string|min:3',
            'username' => 'required|string|min:5',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $imageName = null;
        if ($request->has('pic')) {
            $image = $request->file('pic');
            $image_path = public_path('images\users\\');
            $imageName = time() . '.png';
            $image->move($image_path, $imageName);
        }

        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'expire_date' => Carbon::now()->addYear()->toDate(),
            'membershipID' => $this->generateMembershipID(),
            'pic' => $imageName
        ];

        try {
            User::create($data);
            Session::put('status', ['status' => 200, 'message' => 'ثبت نام باموفقیت انجام شد .']);
            return redirect(route('login'));
        } catch (QueryException $exception) {
            Session::put('status', ['status' => 201, 'message' => $exception->getMessage()]);
            return redirect()->back();
        }

        return redirect(route('users.index'));
    }
    private function generateMembershipID()
    {
        return 'USR-' . now();
    }
}
