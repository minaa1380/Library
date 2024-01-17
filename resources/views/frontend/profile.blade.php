@extends('layouts.front')
@section('title')
    پروفایل : {{ Auth::user()->getFullName() }}
@endsection
@section('content')
    @php
        $user = Auth::user();
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="card-title mb-12 mt-12">
                <span class="me-4">
                    <i class="fas fa-edit text-black"></i>
                </span>
                <h2>ویرایش اطلاعات پروفایل</h2>
            </div>
        </div>
        <div class="card-body pt-5">
            <form id="main_form" class="form" method="post" action="{{ route('users.update', $user->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div id="user_create_inputs">
                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <div class="col">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">نام</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="نام کاربر (اجباری)"></i>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="name" id="name"
                                    value="{{ $user->name }}" />
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
                                <input type="text" class="form-control form-control-solid" name="family" id="family"
                                    value="{{ $user->family }}" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <div class="col">
                            <div class="mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">نام کاربری</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="username" id="username"
                                    value="{{ $user->username }}" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-7">
                                <label class="fs-6 fw-bold mb-3">
                                    <span class="required">رمزعبور</span>
                                </label>
                                <input type="password" class="form-control form-control-solid" name="password"
                                    id="password" placeholder="رمزعبور جدید خود را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <div class="col">
                            <div class="mb-7">
                                <label class="fs-6 fw-bold mb-3">
                                    <span class="required">تکرار رمزعبور</span>
                                </label>
                                <input type="password" class="form-control form-control-solid" name="confirmPassword"
                                    id="confirmPassword" placeholder="تکرار رمزعبور خود را وارد کنید">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-7">
                                <label class="fs-6 fw-bold mb-3">
                                    <span>تصویر کاربر</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title=" file types: png, jpg, jpeg."></i>
                                </label>
                                <input class="form-control form-control-solid" type="file" name="pic" id="pic">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separator mb-6"></div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('users.index') }}">
                        <button type="button" data-kt-contacts-type="cancel" class="btn btn-light me-3">انصراف</button>
                    </a>
                    <button id="form_submit" type="button" data-kt-contacts-type="submit" class="btn btn-primary">
                        <span class="indicator-label">ذخیره</span>
                        <span class="indicator-progress">لطفا صبر کنید...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!--end::Content-->
@endsection
@section('script')
    <script src="{{ asset('js/library/users/create.js') }}"></script>
@endsection
