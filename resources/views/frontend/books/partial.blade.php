@if ($books->total() == 0)
    <div class="alert mt-5 mb-5 alert-danger">
        <p class="fs-3 m-auto">
            * رکوردی بااین مشخصات یافت نشد .</p>
    </div>
@else
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
        <thead>
            <tr class="text-center text-gray-400 fw-bolder fs-7 gs-0">
                <th class="min-w-125px">بارکد</th>
                <th class="min-w-125px">عنوان</th>
                <th class="min-w-125px">نویسنده</th>
                <th class="min-w-125px">انتشارات</th>
                <th class="min-w-125px">دسته بندی</th>
                <th class="min-w-125px">وضعیت</th>
                <th class="min-w-70px">عملیات</th>
            </tr>
        </thead>
        <tbody class="fw-bold text-gray-600 text-center">
            @foreach ($books->items() as $item)
                <tr>
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">#{{ $item->barcode }}</span>
                    </td>
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">{{ $item->title }}</span>
                    </td>
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">{{ $item->author }}</span>
                    </td>
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">{{ $item->publishers }}</span>
                    </td>
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">{{ $item->category->title }}</span>
                    </td>
                    <td>
                        <span class="text-gray-600 text-hover-primary mb-1">{{ $item->getStatus() }}</span>
                    </td>
                    <td class="text-center">
                        @if ($item->status == 0)
                            <div class="btn btn-sm btn-primary submit-reserve"
                                data-link="{{ route('books.reserve', $item->id) }}">
                                <span class="indicator-label">رزرو</span>
                                <span class="indicator-progress">
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </div>
                        @else
                            <div class="badge badge-danger">
                                <span>در دست امانت </span>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $books->links() }}
    </div>
@endif
