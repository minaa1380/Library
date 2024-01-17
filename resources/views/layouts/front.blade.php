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
    <div class="container container-fluid">
        <div class="card mt-3 mb-3">
            <div class="container-fluid pb-3">
                <div class="row">
                    <div class="col-4">
                        <img class="img m-2 rounded-4" src="{{ asset('images/users/' . Auth::user()->pic) }}"
                            style="width: 5rem;" alt="user" />
                        <span class="text-black mb-2 d-block pe-3">
                            {{ Auth::user()->getFullName() }}
                        </span>
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <p class="w-100 fs-1 fw-boldest text-center">{{ $config->app_name }}</p>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    @yield('script')
</body>

</html>
