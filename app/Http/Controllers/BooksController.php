<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Reserve;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(20);
        return view('backend.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'publisher' => 'required|string',
            'author' => 'required|string',
            'category_id' => 'required|integer',
            'inventory' => 'required|integer',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $data = [
            'title' => $request->title,
            'publishers' => $request->publisher,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'inventory' => $request->inventory,
            'barcode' => time(),
            'status' => 0
        ];

        try {
            Book::create($data);
            Session::put('status', ['status' => 200, 'message' => 'کتاب باموفقیت افزوده شد.']);
        } catch (QueryException $exception) {
            return $exception->getMessage();
            Session::put('status', ['status' => 201, 'message' => 'خطا در افزودن رکورد ، مجددا تلاش کنید.']);
        }

        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('backend.books.edit', compact('categories', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'publisher' => 'required|string',
            'author' => 'required|string',
            'category_id' => 'required|integer',
            'inventory' => 'required|integer',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $data = [
            'title' => $request->title,
            'publishers' => $request->publisher,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'inventory' => $request->inventory,
        ];

        try {
            Book::find($id)->update($data);
            Session::put('status', ['status' => 200, 'message' => 'کتاب باموفقیت ویرایش شد.']);
        } catch (QueryException $exception) {
            Session::put('status', ['status' => 201, 'message' => 'خطا در ویرایش رکورد ، مجددا تلاش کنید.']);
        }

        return redirect(route('books.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Book::find($id)->delete();
            return response()->json(['status' => 200, 'message' => 'کتاب باموفقیت حذف شد .']);
        } catch (QueryException $exception) {
            return response()->json(['status' => 201, 'message' => 'خطا در حذف کتاب ، مجددا تلاش کنید .']);
        }
    }

    public function search(Request $request)
    {
        $word = $request->word;
        $books = Book::orWhere('title', 'like', '%' . $word . '%')
            ->orWhere('barcode', 'like', '%' . $word . '%')->paginate(20);

        if ($request->has('isBookPage'))
            return view('backend.books.partial', compact('books'));
        return view('backend.users.books_partial', compact('books'));
    }

    public function reserve($id)
    {        
        $check = $this->checkBook($id);
        if ($check['status'] == 200) {
            $data = [
                'user_id' => Auth::id(),
                'book_id' => $id,
                'reserve_date' => Carbon::now(),
                'period' => 7
            ];
            if ($this->createReserve($data))
                return response()->json(['status' => 200, 'message' => 'کتاب باموفقیت رزرو شد .']);
            return response()->json(['status' => 201, 'message' => 'خطا رد رزرو کتاب ، مجددا تلاش کنید .']);
        }
        return response()->json($check);
    }

    private function createReserve($data)
    {
        try {
            Reserve::create($data);
            Book::find($data['book_id'])->update(['status' => 1]);
            return true;
        } catch (QueryException $th) {
            return $th->getMessage();
        }
    }

    private function checkBook($book_id)
    {
        $book = Book::find($book_id);
        if ($book) {
            // check book exists
            if ($book->inventory > 0) {
                // check book status
                if ($book->status == 0)
                    return ['status' => 200, 'message' => 'ok'];
                return ['status' => 201, 'message' => 'کتاب در دست امانت میباشد.'];
            }
            return ['status' => 202, 'message' => 'کتاب موردنظر موجود نمیباشد.'];
        }
        return ['status' => 203, 'message' => 'شناسه کتاب موجود نمیباشد .'];

        // check book exists
    }

    public function searchJson(Request $request)
    {
        return Book::orWhere('title', 'like', '%' . $request->word . '%')
            ->orWhere('barcode', 'like', '%' . $request->word . '%')
            ->get();
    }
}
