@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="card card-flush h-lg-100">
            <div class="card-header pt-7">
                <div class="card-title">
                    <span class="svg-icon svg-icon-1 me-2">
                        <i class="fas fa-book-open"></i>
                    </span>
                    <h2>ویرایش کتاب </h2>
                </div>
            </div>
            <div class="card-body pt-5">
                <form id="main_form" class="form" method="post" action="{{ route('books.update' , $book->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div id="user_create_inputs">
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">عنوان کتاب</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="title"
                                        id="name" value="{{ $book->title }}" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">انتشارات</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="publisher"
                                        id="publisher" value="{{ $book->publishers }}" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">نویسنده</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="author" id="author"
                                    value="{{ $book->author }}" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>دسته بندی</span>
                                    </label>
                                    <div class="w-100">
                                        <div class="form-floating border rounded">
                                            <select id="category_id" name="category_id"
                                                class="form-select form-select-solid lh-1 py-3" data-control="select2"
                                                data-kt-ecommerce-settings-type="select2_flags"
                                                data-placeholder="انتخاب دسته بندی">
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">تعداد کل</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" name="inventory" id="inventory"
                                    value="{{ $book->inventory }}" />
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>توضیحات</span>
                                    </label>
                                    <textarea class="form-control form-control-solid" name="description" id="description">{{ $book->description }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="mb-7">
                                    <label class="fs-6 fw-bold mb-3">
                                        <span>تصویر کتاب</span>
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
                        <a href="{{ route('books.index') }}">
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
    <script src="{{ asset('js/library/books/create.js') }}"></script>
    <script>
        var category_id = "{{ $book->category_id }}";
        $('#category_id').val(category_id);
        $('#category_id').trigger('change');
    </script>
@endsection
