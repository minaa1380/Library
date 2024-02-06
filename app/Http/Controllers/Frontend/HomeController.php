<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function aboutUs()
    {
        return view('frontend.about_us');
    }
    public function contactUs()
    {
        return view('frontend.contact_us');
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'user_id' => Auth::id(),
                'mobile' => $request->mobile,
                'text' => $request->text
            ];
            Contact::create($data);
            Session::put('status', ['status' => 200, 'message' => 'درخواست شما باموفقیت ثبت شد.']);
        } catch (QueryException $th) {
            Session::put('status', ['status' => 200, 'message' => 'خطا در انجام عملیات ! : ' . $th->getMessage()]);
        }

        return redirect()->back();
    }
}
