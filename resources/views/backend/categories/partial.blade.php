@if ($categories->total())
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
        <thead>
            <tr class="text-center text-gray-400 fw-bolder fs-7 gs-0">
                <th class="min-w-125px">نام</th>
                <th class="min-w-125px">دسته بندی والد</th>
                <th class="min-w-70px">عملیات</th>
            </tr>
        </thead>
        <tbody class="fw-bold text-gray-600 text-center">
            @foreach ($categories->items() as $item)
                <tr data-info="{{ json_encode($item) }}">
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">{{ $item->title }}</span>
                    </td>
                    <td>
                        <span class="text-gray-600 text-hover-primary mb-1">{{ $item->parent->title }}</span>
                    </td>
                    <td class="text-center">
                        <div data-link="{{ route('categories.update' , $item->id) }}" class="btn-sm btn btn-info rounded-pill edit">
                            <span>ویرایش</span>
                        </div>
                        <div class="btn-sm btn btn-danger rounded-pill delete" data-link="{{ route('categories.destroy', $item->id) }}"
                            data-name="{{ $item->title }}">
                            <span>حذف</span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $categories->links() }}
    </div>
@else
    <div class="alert alert-danger">
        * رکوردی یافت نشد !
    </div>
@endif
