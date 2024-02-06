<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <thead>
        <tr class="text-center text-gray-400 fw-bolder fs-7 gs-0">
            <th class="min-w-80px">تصویر</th>
            <th class="min-w-125px">نام و نام خانوادگی</th>
            <th class="min-w-125px">وضعیت</th>
            <th class="min-w-125px">تاریخ اعتبار</th>
            <th class="min-w-70px">عملیات</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600 text-center">
        @foreach ($users->items() as $item)
            <tr>
                <td>
                    <img class="img img-fluid rounded-4 w-40px" src="{{ asset('images/users/' . $item->pic) }}"
                        alt="">
                </td>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $item->getFullName() }}</span>
                </td>
                <td>
                    <span class="text-gray-600 text-hover-primary mb-1">{{ $item->getStatus() }}</span>
                </td>
                <td>
                    <span class="text-gray-600 text-hover-primary mb-1">{{ $item->getExpireDate() }}</span>
                </td>
                <td class="text-center">
                    <div class="btn btn-primary user_submit_reserve" data-user-id="{{ $item->id }}"
                        data-link="{{ route('users.books.reserve') }}">
                        <span class="indicator-label">رزرو</span>
                        <span class="indicator-progress">لطفا صبر کنید...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
    {{ $users->links() }}
</div>
