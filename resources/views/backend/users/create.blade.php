@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="card card-flush h-lg-100">
            <div class="card-header pt-7">
                <div class="card-title">
                    <span class="svg-icon svg-icon-1 me-2">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <h2>افزودن کاربر جدید</h2>
                </div>
            </div>
            <div class="card-body pt-5">
                <form id="main_form" class="form" method="post" action="{{ route('users.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="user_create_inputs">
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">نام</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="نام کاربر (اجباری)"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="name"
                                        id="name" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">نام خانوادگی</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="نام خانوادگی (اجباری)"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="family"
                                        id="family" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">نام کاربری</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="username" id="username"
                                    value="" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>نوع کاربری</span>
                                    </label>
                                    <div class="w-100">
                                        <div class="form-floating border rounded">
                                            <select id="user_type" name="user_type"
                                                class="form-select form-select-solid lh-1 py-3" data-control="select2"
                                                data-kt-ecommerce-settings-type="select2_flags"
                                                data-placeholder="انتخاب نوع کاربری">
                                                <option value="0">کاربر</option>
                                                <option value="1">ادمین</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                <div class="col">
                                    <div class="mb-7">
                                        <label class="fs-6 fw-bold mb-3">
                                            <span>تصویر کاربر</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                title=" file types: png, jpg, jpeg."></i>
                                        </label>
                                        <input type="file" name="pic" id="pic">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('users.index') }}">
                                <button type="button" data-kt-contacts-type="cancel"
                                    class="btn btn-light me-3">انصراف</button>
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
    <script src="{{ asset('js/library/users/create.js') }}"></script>
@endsection
