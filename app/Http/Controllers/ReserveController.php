<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index()
    {
        $reserves = Reserve::paginate(10);
        return view('backend.reserve.index', compact('reserves'));
    }

    public function create()
    {
        return view('backend.reserve.create');
    }

    public function store(Request $request)
    {
    }
    public function edit($id)
    {
    }
    public function update($id, Request $request)
    {
    }
    public function destroy($id)
    {
    }
}
