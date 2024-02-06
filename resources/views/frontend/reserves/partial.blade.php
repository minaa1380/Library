<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <thead>
        <tr class="text-center text-gray-400 fw-bolder fs-7 gs-0">
            <th class="min-w-125px">عنوان</th>
            <th class="min-w-125px">نویسنده</th>
            <th class="min-w-125px">بارکد</th>
            <th class="min-w-125px">تاریخ رزرو</th>
            <th class="min-w-125px">موعد تحویل</th>
            <th class="min-w-125px">جریمه</th>
            <th class="min-w-70px">وضعیت</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600 text-center">
        @foreach ($reserves->items() as $item)
            <tr>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $item->book->title }}</span>
                </td>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">{{ $item->book->author }}</span>
                </td>
                <td>
                    <span class="text-gray-800 text-hover-primary mb-1">#{{ $item->book->barcode }}</span>
                </td>
                <td>
                    <span class="text-gray-600 text-hover-primary mb-1">{{ $item->getReserveDate() }}</span>
                </td>
                <td>
                    <span class="text-gray-600 text-hover-primary mb-1">{{ $item->getDeliveryDate() }}</span>
                </td>
                <td>
                    <span class="text-gray-600 text-hover-primary mb-1">{{ $item->getPenalty() }}</span>
                </td>
                <td>
                    @if ($item->delivery_date == null)
                        <div class="badge badge-info">
                            <span>تحویل نشده</span>
                        </div>
                    @else
                        <div class="badge badge-primary">
                            <span>تحویل شده</span>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="">
    {{ $reserves->links() }}
</div>
