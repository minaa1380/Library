@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="card card-flush h-lg-100">
            <div class="card-body pt-5">
                <form id="main_form" class="form" method="post" action="{{ route('config.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <div class="col">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">نام سامانه</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="name" id="name"
                                    value="{{ $config->app_name }}" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">مبلغ جریمه دیرکرد یک روز (ریال)</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="penalty_for_day"
                                    id="penalty_for_day" value="{{ $config->penalty_for_day }}" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <div class="col">
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">هزینه ثبت نام</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" name="register_cost" id="register_cost"
                                value="{{ $config->register_cost }}" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="col">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">هزینه تمدید</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="update_cost" id="update_cost"
                                    value="{{ $config->update_cost }}" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <div class="col">
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">حداکثر امانت باز برای هر کاربر</span>
                            </label>
                            <input type="number" class="form-control form-control-solid" name="max_user_reserve" id="max_user_reserve"
                                value="{{ $config->max_user_reserve }}" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="col">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">لوگوی سامانه</span>
                                </label>
                                <input type="file" class="form-control form-control-solid" name="logo" id="logo">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="separator mb-6"></div>
                    <div class="d-flex justify-content-end">
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
    <script src="{{ asset('js/library/configs/index.js') }}"></script>
@endsection
