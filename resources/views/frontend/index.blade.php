@extends('layouts.front')
@section('title')
پنل کاربری : {{ Auth::user()->getFullName() }}
@endsection
@section('style')
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
@endsection
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card shadow-sm">
                <a href="{{ route('panel.books.index') }}">
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
                <a href="{{ route('myProfile.index') }}">
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
@endsection
@section('script')
    <script src="{{ asset('js/customize/frontend/index.js') }}"></script>
@endsection
