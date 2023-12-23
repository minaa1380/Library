<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::where('id', '>', 1)->paginate(10);
        return view('backend.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['title', 'parent_id']), [
            'title' => 'required|string|min:3',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        try {
            Category::create($request->only(['title', 'parent_id']));
            Session::put('status', ['status' => 200, 'message' => 'دسته بندی باموفقیت افزوده شد.']);
        } catch (QueryException $exception) {
            return $exception->getMessage();
            Session::put('status', ['status' => 201, 'message' => 'خطا در افزودن رکورد ، مجددا تلاش کنید.']);
        }

        return redirect(route('categories.index'));
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->only(['title', 'parent_id']), [
            'title' => 'required|string|min:3',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        try {
            Category::find($id)->update($request->only(['title', 'parent_id']));
            Session::put('status', ['status' => 200, 'message' => 'دسته بندی باموفقیت ویرایش شد.']);
        } catch (QueryException $exception) {
            return $exception->getMessage();
            Session::put('status', ['status' => 201, 'message' => 'خطا در ویرایش رکورد ، مجددا تلاش کنید.']);
        }

        return redirect(route('categories.index'));
    }
    public function destroy($id)
    {
        if (Category::find($id)->delete())
            return response()->json(['status' => 200, 'message' => 'دسته بندی باموفقیت حذف شد.']);
        return response()->json(['status' => 201, 'message' => 'خطا در حذف دسته بندی ، مجددا تلاش کنید..']);
    }
}
