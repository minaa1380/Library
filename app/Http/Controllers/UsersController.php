<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reserve;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'family' => 'required|string|min:3',
            'username' => 'required|string|min:5',
            'user_type' => 'required|integer',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $imageName = null;
        if ($request->has('pic')) {
            $image = $request->file('pic');
            $image_path = public_path('images\users\\');
            $imageName = time() . '.png';
            $image->move($image_path, $imageName);
        }

        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'username' => $request->username,
            'password' => bcrypt($request->username),
            'user_type' => $request->user_type,
            'expire_date' => Carbon::now()->addYear()->toDate(),
            'membershipID' => $this->generateMembershipID(),
            'pic' => $imageName
        ];

        try {
            User::create($data);
            Session::put('status', ['status' => 200, 'message' => 'کاربر باموفقیت افزوده شد.']);
        } catch (QueryException $exception) {
            Session::put('status', ['status' => 201, 'message' => 'خطا در افزودن رکورد ، مجددا تلاش کنید.']);
        }

        return redirect(route('users.index'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.users.edit', compact('user'));
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'family' => 'required|string|min:3',
            'username' => 'required|string|min:5',
            'user_type' => 'required|integer',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $imageName = null;
        if ($request->has('pic')) {
            $image = $request->file('pic');
            $image_path = public_path('images\users\\');
            $imageName = time() . '.png';
            $image->move($image_path, $imageName);
        }

        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'username' => $request->username,
            'user_type' => $request->user_type,
            'pic' => $imageName
        ];

        try {
            User::find($id)->update($data);
            Session::put('status', ['status' => 200, 'message' => 'کاربر باموفقیت ویرایش شد.']);
        } catch (QueryException $exception) {
            Session::put('status', ['status' => 201, 'message' => 'خطا در ویرایش رکورد ، مجددا تلاش کنید.']);
        }

        return redirect(route('users.index'));
    }
    public function destroy($id)
    {
        if (User::find($id)->delete())
            return response()->json(['status' => 200, 'message' => 'کاربر باموفقیت حذف شد.']);
        return response()->json(['status' => 201, 'message' => 'خطا در حذف کاربر ، مجددا تلاش کنید..']);
    }

    public function searchJson(Request $request)
    {
        return User::orWhere('name', 'like', '%' . $request->word . '%')
            ->orWhere('family', 'like', '%' . $request->word . '%')
            ->orWhere('membershipID', 'like', '%' . $request->word . '%')
            ->get();
    }
    public function search(Request $request)
    {
        $users = User::orWhere('name', 'like', '%' . $request->word . '%')
            ->orWhere('family', 'like', '%' . $request->word . '%')
            ->orWhere('membershipID', 'like', '%' . $request->word . '%')
            ->paginate(20);

        if ($request->has('isBookPage'))
            return view('backend.books.users_partial', compact('users'));
        return view('backend.users.partial', compact('users'));
    }

    public function reserve(Request $request)
    {
        $check = $this->checkBook($request->book_id);
        if ($check['status'] == 200) {
            $data = [
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
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

    private function generateMembershipID()
    {
        return 'USR-' . now();
    }
}
