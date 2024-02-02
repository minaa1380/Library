@extends('layouts.front')
@section('title')
    پنل کاربری : {{ Auth::user()->getFullName() }}
@endsection
@section('style')
    <style>
        .status_checkBox>label {
            margin: 0 12px auto;
            font-size: 16px;
        }

        .status_checkBox>label>input {
            margin: 12px 0 auto;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header pt-5 pb-5">
            <div class="d-flex align-items-center position-relative my-1" style="width: 70%">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <input id="search_input" type="text" data-kt-customer-table-filter="search"
                    class="form-control form-control-solid w-100 ps-15 fs-2" placeholder="نام کتاب را جستجو کنید ..." />
            </div>
            <div class="d-flex align-items-center position-relative">
                <div class="status_checkBox">
                    <label for="free">
                        <input type="checkbox" name="status[]" value="0" id="free">
                        آزاد
                    </label>
                </div>
                <div class="status_checkBox">
                    <label for="reserved">
                        <input type="checkbox" name="status[]" value="1" id="reserved">
                        درامانت
                    </label>
                </div>
            </div>
            <div class="d-flex align-items-center position-relative">
                <div class="btn btn-sm btn-success" id="btn-search">
                    <span>جستجو</span>
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3" style="display: none" id="list">
        <div class="card-header">
            <span class="fs-2" style="margin: auto 10px;">لیست کتب</span>
        </div>
        <div class="card-body">
            <div id="table">
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        let token = "{{ csrf_token() }}";
        let search_url = "{{ route('panel.books.search') }}";
    </script>
    <script src="{{ asset('js/customize/frontend/books.js') }}"></script>
@endsection
