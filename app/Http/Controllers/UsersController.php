<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'family' => 'required|string|min:3',
            'username' => 'required|string|min:5',
            'user_type' => 'required|integer',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'username' => $request->username,
            'password' => bcrypt($request->username),
            'user_type' => $request->user_type,
            'expire_date' => Carbon::now()->addYear()->toDate(),
        ];

        try {
            User::create($data);
            Session::put('status', ['status' => 200, 'message' => 'کاربر باموفقیت افزوده شد.']);
        } catch (QueryException $exception) {
            Session::put('status', ['status' => 201, 'message' => 'خطا در افزودن رکورد ، مجددا تلاش کنید.']);
        }

        return redirect(route('users.index'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.users.edit', compact('user'));
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'family' => 'required|string|min:3',
            'username' => 'required|string|min:5',
            'user_type' => 'required|integer',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'username' => $request->username,
            'user_type' => $request->user_type,
        ];

        try {
            User::find($id)->update($data);
            Session::put('status', ['status' => 200, 'message' => 'کاربر باموفقیت ویرایش شد.']);
        } catch (QueryException $exception) {
            Session::put('status', ['status' => 201, 'message' => 'خطا در ویرایش رکورد ، مجددا تلاش کنید.']);
        }

        return redirect(route('users.index'));
    }
    public function destroy($id)
    {
        if (User::find($id)->delete())
            return response()->json(['status' => 200, 'message' => 'کاربر باموفقیت حذف شد.']);
        return response()->json(['status' => 201, 'message' => 'خطا در حذف کاربر ، مجددا تلاش کنید..']);
    }

    public function searchJson(Request $request)
    {
        return User::orWhere('name', 'like', '%' . $request->word . '%')
            ->orWhere('family', 'like', '%' . $request->word . '%')
            ->orWhere('membershipID', 'like', '%' . $request->word . '%')
            ->get();
    }

    public function generateMembershipID(){}
}
