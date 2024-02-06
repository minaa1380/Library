<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
        if (!$this->checkCategory($id)) {
            if (Category::find($id)->delete())
                return response()->json(['status' => 200, 'message' => 'دسته بندی باموفقیت حذف شد.']);
            return response()->json(['status' => 201, 'message' => 'خطا در حذف دسته بندی ، مجددا تلاش کنید..']);
        } else
            return response()->json(['status' => 202, 'message' => 'دسته بندی دارای کتاب میباشد !']);
    }

    public function search(Request $request)
    {
        $query = Category::query();
        if ($request->has('word'))
            $query = $query->where('title', 'like', '%' . $request->word . '%')->where('id', '>', 1);
        $categories = $query->paginate(20);
        return view('backend.categories.partial', compact('categories'));
    }

    private function checkCategory($category_id)
    {
        return Book::whereCategoryId($category_id)->exists();
    }
}
