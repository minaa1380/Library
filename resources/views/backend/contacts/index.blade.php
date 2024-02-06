@extends('layouts.dashboard')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-toolbar">
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
                    <div id="table">
                        @include('backend.contacts.partial')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
