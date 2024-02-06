<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservesController extends Controller
{
    public function index()
    {
        $reserves = Auth::user()->reserves()->paginate(20);
        return view('frontend.reserves.index', compact('reserves'));
    }

    private $word;
    public function search(Request $request)
    {
        $result = Auth::user()->reserves();

        if ($request->has('word')) {
            $this->word = $request->word;
            $result = $result
                ->whereHas('book', function ($query) {
                    return $query->where('title', 'like', '%' . $this->word . '%');
                });
        }

        $reserves = $result->paginate(20);
        return view('frontend.reserves.partial', compact('reserves'));
    }
}
