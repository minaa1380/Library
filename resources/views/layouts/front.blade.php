<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />
    <title>@yield('title')</title>
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
</head>
@php
    $config = App\Models\Config::first();
@endphp

<body style="direction: rtl">
    <div class="container container-fluid" style="padding-bottom: 120px">
        <div class="card card-first mt-10 mb-3">
            <div class="container-fluid p-3 m-auto">
                <div class="row">
                    <div class="col-4 d-flex align-items-center ps-5">
                        @if (request()->url() != route('panel'))
                            <a href="{{ route('panel') }}">
                                <div class="btn btn btn-danger btn-icon rounded-circle">
                                    <i class="fas fa-home fs-3"></i>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <p class="w-100 fs-1 fw-boldest text-center m-auto">{{ $config->app_name }}</p>
                    </div>
                    <div class="col-4 pe-10" dir="ltr">
                        <div class="text-center" style="width: 75px;">
                            <img class="img m-2 m-auto rounded-4" src="{{ asset('images/users/' . Auth::user()->pic) }}"
                                style="max-width: 75px" alt="user" />
                            <span class="text-black mb-2 d-block">
                                {{ Auth::user()->getFullName() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

    <div style="max-height: 90px">
        @include('layouts.footer')
    </div>

    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    @yield('script')
</body>
<script>
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

</html>
