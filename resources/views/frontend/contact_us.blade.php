@extends('layouts.front')
@section('title')
    درباره ما
@endsection
@section('content')
    <div class="row mt-12">
        <h2 class="ms-8 text-start d-inline-block">
            <i class="fas fa-info-circle fs-2 align-middle"></i>
            <span>تماس با ما</span>
        </h2>
    </div>
    <div class="card mt-8">
        <div class="card-body pt-5">
            <form id="main_form" class="form" method="post" action="{{ route('contact.store') }}">
                @csrf
                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span>نام و نام خانوادگی</span>
                            </label>
                            <span class="form-control form-control-solid">{{ Auth::user()->getFullName() }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">شماره موبایل</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="شماره موبایل (اجباری)"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" name="mobile" id="mobile" />
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-7">
                        <label class="fs-6 fw-bold form-label mt-3">
                            <span class="required">متن</span>
                        </label>
                        <textarea rows="5" class="form-control form-control-solid" name="text" id="text"></textarea>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                </div>
                <div class="separator mb-6"></div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('panel') }}">
                        <button type="button" data-kt-contacts-type="cancel" class="btn btn-light me-3">بازگشت</button>
                    </a>
                    <button id="form_submit" type="button" data-kt-contacts-type="submit" class="btn btn-primary">
                        <span class="indicator-label">ذخیره</span>
                        <span class="indicator-progress">لطفا صبر کنید...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#form_submit').click(function() {
            $('#main_form').submit();
        });
    </script>
@endsection
