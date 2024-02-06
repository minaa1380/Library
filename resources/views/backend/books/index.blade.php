@extends('layouts.dashboard')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <input id="search_input" type="text" data-kt-customer-table-filter="search"
                                class="form-control form-control-solid w-500px ps-15"
                                placeholder="نام ، نام خانوادگی و یا نام کاربری را جستجو کنید ..." />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <a href="{{ route('books.create') }}">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-book-medical"></i>
                                    افزودن کتاب جدید</button>
                            </a>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-customer-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"></span>انتخاب شده
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-customer-table-select="delete_selected">حذف انتخاب شده
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="mainTable">
                        @include('backend.books.partial')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Reserve Modal -->
    <div id="reserveModal" class="modal modal- fade bearingsmodal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>
                        رزرو کتاب <span id="book" class="text-danger"></span>
                    </h2>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title w-100">
                                <div class="d-flex align-items-center position-relative my-1 w-100">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <input id="search_input_modal" type="text" data-kt-customer-table-filter="search"
                                        class="form-control form-control-solid ps-15"
                                        placeholder="نام کاربر و یا شماره عضویت آن را جستجو کنید ..." />
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="table">
                                {{-- @include('backend.books.partial') --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div style="float: right;">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                بستن
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reserve Modal -->
@endsection
@section('script')
    <script src="{{ asset('js/library/books/index.js') }}"></script>
    <script>
        let token = "{{ csrf_token() }}";
        let search_url = "{{ route('books.search') }}";
        let users_search_url = "{{ route('users.search') }}";
        main_id = 5, sub_id = 1;

        @if (Session::exists('status'))
            Swal.fire({
                html: `{{ Session::get('status')['message'] }}`,
                icon: @if (Session::pull('status')['status'] == 200)
                    "success"
                @else
                    "error"
                @endif ,
                buttonsStyling: false,
                showCancelButton: true,
                showConfirmButton: false,
                cancelButtonText: "باشه",
                customClass: {
                    cancelButton: "btn btn-primary",
                }
            });
        @endif
    </script>
@endsection
