<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('backend.configs.index', compact('config'));
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'app_name' => $request->name,
                'penalty_for_day' => str_replace(',', '', $request->penalty_for_day),
                'register_cost' => str_replace(',', '', $request->register_cost),
                'update_cost' => str_replace(',', '', $request->update_cost),
                'max_user_reserve' => $request->max_user_reserve,
            ];

            Config::updateOrCreate(['id' => 1], $data);
            Session::put('status', ['status' => 200, 'message' => 'تنظیمات باموفقیت ثبت شد.']);
        } catch (QueryException $th) {
            Session::put('status', ['status' => 201, 'message' => 'خطا در ثبت تنظیمات ، مجددا تلاش کنید.']);
        }

        return redirect()->back();
    }

    private function create($data)
    {
        try {
            Config::create($data);
            return true;
        } catch (QueryException $th) {
            return false;
        }
    }
    private function update($config, $data)
    {
        try {
            $config->update($data);
            return true;
        } catch (QueryException $th) {
            return false;
        }
    }
}
