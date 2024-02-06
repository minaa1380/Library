<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <thead>
        <tr class="text-center text-gray-400 fw-bolder fs-7 gs-0">
            <th class="min-w-125px">ش.عضویت</th>
            <th class="min-w-125px">نام و نام خانوادگی</th>
            <th class="min-w-125px">نام کاربری</th>
            <th class="min-w-125px">تلفن همراه</th>
            <th class="min-w-125px">متن درخواست</th>
            <th class="min-w-125px">تاریخ ثبت درخواست</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600 text-center">
        @foreach ($contacts->items() as $item)
            <tr>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">#{{ $item->user->membershipID }}</span>
                </td>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $item->user->getFullName() }}</span>
                </td>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $item->user->username }}</span>
                </td>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $item->mobile }}</span>
                </td>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $item->text }}</span>
                </td>
                <td>
                    <span class="text-gray-600 text-hover-primary mb-1">{{ $item->created_at }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
    {{ $contacts->links() }}
</div>
