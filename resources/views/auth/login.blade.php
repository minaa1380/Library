<!DOCTYPE html>
<!--
نویسنده: ساتراس وب
محصولات نام: مترونیک - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin داشبورد Theme
خرید: https://1.envato.market/EA4JP
وب سایت: http://www.keenthemes.com
تماس با ما: support@keenthemes.com
دنبال کردن: www.twitter.com/keenthemes
دریبل: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
لاینسس شده: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>قالب مدیریت مترونیک</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced پنل ادمین بوت استراپ Theme on Themeforest trusted by 94,000 beginners و professionals. Multi-demo, حالت تیره, RTL support و complete React, Angular, Vue &amp; Laravel versions. Grab your copy now و get life-time updates for free." />
    <meta name="keywords"
        content="مترونیک, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="قالب مدیریت مترونیک" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="ساتراس وب | مترونیک" />
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::احراز هویت - ورود -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::کناری-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                style="background-color: #F2C98A">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <!--begin::Content-->
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <!--begin::Logo-->
                        <a href="../../demo1/dist/index.html" class="py-9 mb-5">
                            <img alt="Logo" src="{{ asset('images/logo.png') }}" class="h-60px" />
                        </a>
                        <!--end::Logo-->
                        <!--begin::Title-->
                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">
                            به سامانه {{ $config->app_name }} خوش آمدید
                        </h1>
                        <!--end::Title-->
                        <!--begin::توضیحات-->
                        <p class="fw-bold fs-2" style="color: #986923;">
                            رزرو سریع کتب
                            <br />
                            براحتی هرچه تمام ، کتب و کاربران را مدیریت کن
                        </p>
                        <!--end::توضیحات-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Illustration-->
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url({{ asset('media/illustrations/sketchy-1/13.png') }})"></div>
                    <!--end::Illustration-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::کناری-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                            action="{{ route('login') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3">ورود به مترونیک</h1>
                                <!--end::Title-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Tags-->
                                <label class="form-label fs-6 fw-bolder text-dark">نام کاربری</label>
                                <!--end::Tags-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                    id="username" name="username" autocomplete="off" />
                                <!--end::Input-->
                                <span class="invalid-feedback"></span>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack mb-2">
                                    <!--begin::Tags-->
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">کلمه عبور</label>
                                    <!--end::Tags-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    id="password" name="password" autocomplete="off" />
                                <!--end::Input-->
                                <span class="invalid-feedback"></span>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <!--begin::ثبت button-->
                                <button type="button" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">ادامه</span>
                                    <span class="indicator-progress">لطفا صبر کنید...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <a href="{{ route('register') }}" class="btn btn-lg btn-light-primary w-100 mb-5">
                                    <span>ثبت نام</span>
                                </a>
                                <!--end::ثبت button-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    <!--begin::Links-->

                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::احراز هویت - ورود-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page سفارشی Javascript(used by this page)-->
    <script src="{{ asset('js/library/login.js') }}"></script>
    <!--end::Page custom Javascript-->
    <!--end::Javascript-->
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
</body>
<!--end::Body-->

</html>
