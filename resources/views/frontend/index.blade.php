<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .img-item {
            background-repeat: no-repeat;
            background-position: center;
            height: 14rem;
        }

        .card {
            transition: transform .5s;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 10px;
        }

        a {
            color: black !important;
        }

        a>.bg-primary {
            border-bottom-left-radius: 0.625rem;
            border-bottom-right-radius: 0.625rem;
        }
    </style>
</head>

<body>
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
        <div class="row">
            <div class="col-4">
                <div class="card shadow-sm">
                    <a href="">
                        <div class="card-body img-item m-8"
                            style="background-image: url({{ asset('images/icons/book-search.svg') }});">
                        </div>
                        <div class="p-6 text-center bg-primary">
                            <p class="m-auto fs-5 fw-bold">جستجوی کتاب</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow-sm">
                    <a href="">
                        <div class="card-body img-item m-8"
                            style="background-image: url({{ asset('images/icons/reserve2.svg') }});">
                        </div>
                        <div class="p-6 text-center bg-primary">
                            <p class="m-auto fs-5 fw-bold">رزرو کتاب</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow-sm">
                    <a href="">

                        <div class="card-body img-item m-8"
                            style="background-image: url({{ asset('images/icons/reserve-history.svg') }});">
                        </div>
                        <div class="p-6 text-center bg-primary">
                            <p class="m-auto fs-5 fw-bold">تاریخچه رزرو</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
                <div class="card shadow-sm">
                    <a href="">
                        <div class="card-body img-item m-8"
                            style="background-image: url({{ asset('images/icons/profile.svg') }});">
                        </div>
                        <div class="p-6 text-center bg-primary">
                            <p class="m-auto fs-5 fw-bold">پروفایل</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow-sm">
                    <a href="">
                        <div class="card-body img-item m-8"
                            style="background-image: url({{ asset('images/icons/payment.svg') }});">
                        </div>
                        <div class="p-6 text-center bg-primary">
                            <p class="m-auto fs-5 fw-bold">تاریخچه پرداختی ها</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow-sm">
                    <a id="exit">
                        <form id="exitForm" method="post" action="{{ route('logout') }}">
                            @csrf
                        </form>
                        <div class="card-body img-item m-8"
                            style="background-image: url({{ asset('images/icons/exit.svg') }});">
                        </div>
                        <div class="p-6 text-center bg-primary">
                            <p class="m-auto fs-5 fw-bold">خروج</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('js/customize/frontend/index.js') }}"></script>
</body>

</html>
