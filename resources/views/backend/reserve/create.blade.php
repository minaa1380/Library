@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="card card-flush h-lg-100">
            <div class="card-header pt-7">
                <div class="card-title">
                    <span class="svg-icon svg-icon-1 me-2">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <h2>ثبت امانت کتاب</h2>
                </div>
            </div>
            <div class="card-body pt-5">
                <form id="main_form" class="form" method="post" action="{{ route('reserve.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id">
                    <input type="hidden" name="book_id">
                    <div id="user_create_inputs">
                        <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">کاربر</span>
                                    </label>
                                    <div class="border rounded">
                                        <select id="kt-user" class="form-select form-select-transparent" name="user"
                                            data-placeholder="لطفا کاربر را انتخاب کنید ...">
                                        </select>
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">کتاب</span>
                                    </label>
                                    <div class="border rounded">
                                        <select id="kt-book" class="form-select form-select-transparent" name="book"
                                            data-placeholder="لطفا کتاب را انتخاب کنید ...">
                                        </select>
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">مدت (به روز)</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" name="period" id="period"
                                    value="" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="separator mb-6"></div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('reserve.index') }}">
                            <button type="button" data-kt-contacts-type="cancel" class="btn btn-light me-3">انصراف</button>
                        </a>
                        <button id="form_submit" type="button" data-kt-contacts-type="submit" class="btn btn-primary">
                            <span class="indicator-label">ذخیره</span>
                            <span class="indicator-progress">لطفا صبر کنید...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <!--end::Content-->
@endsection
@section('script')
    <script>
        let token = "{{ csrf_token() }}";
        let userPicPath = "{{ asset('image/users') . '/' }}";
        let userSearchUrl = "{{ route('users.search.json') }}";
        let bookPicPath = "{{ asset('image/books') . '/' }}";
        let bookSearchUrl = "{{ route('books.search.json') }}";
        let selectedManager = null;
    </script>
    <script src="{{ asset('js/library/reserve/create.js') }}"></script>

@endsection
