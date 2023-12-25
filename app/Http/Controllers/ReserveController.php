<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Config;
use App\Models\Reserve;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        if ($this->checkUser($request->user))
            if ($this->checkBook($request->book)) {
                if ($this->insert($request->only(['user_id', 'book_id', 'period'])))
                    Session::put('status', ['status' => 200, 'message' => 'کتاب باموفقیت رزرو شد.']);
                else
                    Session::put('status', ['status' => 201, 'message' => 'خطا در انجام عملیات ، مجددا تلاش کنید.']);
            } else
                Session::put('status', ['status' => 202, 'message' => 'این کتاب درحال حاضر موجود نمیباشد.']);
        else
            Session::put('status', ['status' => 203, 'message' => 'سقف مجاز رزرو برای این کاربر تکمیل است.']);

        return redirect()->back();
    }
    public function edit($id)
    {
    }
    public function update($id, Request $request)
    {
    }

    public function destroy($id)
    {
        try {
            Reserve::find($id)->delete();
            return response()->json(['status' => 200, 'message' => 'رکورد باموفقیت حذف شد .']);
        } catch (QueryException $exception) {
            return response()->json(['status' => 201, 'message' => 'خطا در حذف رکورد ، مجددا تلاش کنید .']);
        }
    }

    private function checkPenalty($reserve_id)
    {

        $cost = 0;
        $reserve = Reserve::find($reserve_id);
        $deliveryDate = Carbon::parse($reserve->reserve_date)->addDays($reserve->period);
        // return Carbon::parse($reserve->reserve_date)->addDays($reserve->period);
        if ($deliveryDate < Carbon::now())
            $cost = ($deliveryDate->diffInDays(Carbon::now())) * Config::first()->penalty_for_day;

        return $cost;
    }

    public function delivery($id)
    {
        $data = ['delivery_date' => Carbon::now(), 'cost' => $this->checkPenalty($id)];
        try {
            Reserve::find($id)->update($data);
            return response()->json(['status' => 200, 'message' => 'عملیات باموفقیت انجام شد .']);
        } catch (QueryException $exception) {
            return response()->json(['status' => 201, 'message' => 'خطا در انجام عملیات ، مجددا تلاش کنید .']);
        }
    }


    public function search(Request $request)
    {

        $word = $request->word;
        $reserves = Reserve::with(['user', 'book'])
            ->orWhereRelation('user', 'name', 'like', '%' . $word . '%')
            ->orWhereRelation('user', 'family', 'like', '%' . $word . '%')
            ->orWhereRelation('user', 'memberShipId', 'like', '%' . $word . '%')
            ->orWhereRelation('book', 'title', 'like', '%' . $word . '%')
            ->orWhereRelation('book', 'barcode', 'like', '%' . $word . '%')
            ->paginate(10);
        // $reserves = Reserve::with(['user', 'book'])
        //     ->whereRelation('user', function ($query) use ($word) {
        //         $query->where('name', 'like', '%' . $word . '%')
        //             ->orWhere('family', 'like', '%' . $word . '%');
        //             // ->orWhere('memberShipId', 'like', '%' . $word . '%');
        //     })
        //     ->whereRelation('book', function ($query2) use ($word) {
        //         $query2->where('title', 'like', '%' . $word . '%')
        //             ->orWhere('barcode', 'like', '%' . $word . '%');
        //     })
        //     ->paginate(10);

        return view('backend.reserve.partial', compact('reserves'));
    }

    private function checkUser($user_id)
    {
        return (Reserve::whereUserId($user_id)->whereNull('delivery_date')->count() < 3) ? 1 : 0;
    }

    private function checkBook($book_id)
    {
        $count = Book::find($book_id)->inventory;
        $countReserved = Reserve::whereBookId($book_id)->where('delivery_date', null)->count();
        if ($count > $countReserved)
            return true;
        return false;
    }

    private function insert($data)
    {
        try {
            $data['reserve_date'] = Carbon::now();
            Reserve::create($data);
            return true;
        } catch (QueryException $th) {
            return false;
        }
    }
}
