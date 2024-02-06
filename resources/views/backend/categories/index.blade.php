@extends('layouts.dashboard')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-2">
                <div class="card-body pt-5">
                    <form id="main_form" class="form" method="post" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">عنوان دسته بندی</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="نام دسته بندی (اجباری)"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="title"
                                        id="title" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>دسته والد</span>
                                    </label>
                                    <div class="w-100">
                                        <div class="form-floating border rounded">
                                            <select id="parent_id" name="parent_id"
                                                class="form-select form-select-solid lh-1 py-3" data-control="select2"
                                                data-kt-ecommerce-settings-type="select2_flags"
                                                data-placeholder="انتخاب نوع کاربری">
                                                <option value="1">فاقد دسته والد</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator mb-6"></div>

                        <div class="d-flex justify-content-end">
                            <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">انصراف</button>
                            <button id="form_submit" type="button" data-kt-contacts-type="submit" class="btn btn-primary">
                                <span class="indicator-label">ذخیره</span>
                                <span class="indicator-progress">لطفا صبر کنید...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-0 pt-3">
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
                                placeholder="عنوان دسته بندی را جستجو کنید ..." />
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="table">
                        @include('backend.categories.partial')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade bearingsmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    ویرایش دسته بندی
                </div>
                <div class="modal-body">
                    <form id="main_form" class="form" method="post" action="{{ route('categories.store') }}">
                        @csrf
                        @method('patch')
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">عنوان دسته بندی</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="نام دسته بندی (اجباری)"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="title"
                                        id="title" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>دسته والد</span>
                                    </label>
                                    <div class="w-100">
                                        <div class="form-floating border rounded">
                                            <select id="parent_id" name="parent_id"
                                                class="form-select form-select-solid lh-1 py-3" data-control="select2"
                                                data-kt-ecommerce-settings-type="select2_flags"
                                                data-placeholder="انتخاب نوع کاربری">
                                                <option value="1">فاقد دسته والد</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end">
                            <button id="form_cancell" type="button" data-kt-contacts-type="cancel"
                                class="btn btn-light me-3">انصراف</button>
                            <button id="form_submit" type="button" data-kt-contacts-type="submit"
                                class="btn btn-primary">
                                <span class="indicator-label">ویرایش</span>
                                <span class="indicator-progress">لطفا صبر کنید...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>

                </div>
                {{-- <div class="modal-footer">
                    <div style="float: right;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"></button>
                        <div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let token = "{{ csrf_token() }}";
        let search_url = "{{ route('category.search') }}";
    </script>
    <script src="{{ asset('js/library/categories/index.js') }}"></script>
    <script>
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
