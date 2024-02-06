<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index()
    {
        return view('backend.profile.index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    /* public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    } */

    /**
     * Update the user's profile information.
     */


    public function update(Request $request)
    {
        try {
            $user = User::find(Auth::id());
            $data = ($request->password == null) ? $request->except(['password', 'confirmPassword', '_token']) : $request->except('_token');
            if ($request->has('pic')) {
                $image = $request->file('pic');
                $image_path = public_path('images/users/');
                if (file_exists($image_path . Auth::id() . '.png'))
                    unlink($image_path . Auth::id() . '.png');
                $image->move($image_path, Auth::id() . '.png');
                $data['pic'] = Auth::id() . '.png';
            }
            $user->update($data);
            Session::put('status', ['status' => 200, 'message' => 'اطلاعات پروفایل باموفقیت ویرایش شد']);
            return redirect()->back();
        } catch (QueryException $exception) {
            Session::put('status', ['status' => 201, 'message' => 'اطلاعات پروفایل ویرایش نشد، مجددا تلاش کنید']);
            return redirect()->back();
        }
    }

    /**
     * Delete the user's account.
     */
    /*     public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    } */
}
