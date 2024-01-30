<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::paginate(20);
        return view('frontend.books.index', compact('books'));
    }

    public function search(Request $request)
    {
        $result = Book::query();

        if ($request->has('status')) {
            if ($request->status == 0)
                $result = $result->whereStatus(0);
            else if ($request->status == 1)
                $result = $result->whereStatus(1);
        }

        if ($request->has('word')) {
            $result = $result
                ->where('title', 'like', '%' . $request->word . '%');
            // $result = $result
            //     ->orWhere('publishers', 'like', '%' . $request->word . '%');
            // $result = $result
            //     ->orWhere('barcode', 'like', '%' . $request->word . '%');
            // $result = $result
            //     ->orWhere('author', 'like', '%' . $request->word . '%');
        }

        $books = $result->paginate(20);
        return view('frontend.books.partial', compact('books'));
    }
}
