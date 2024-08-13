{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('2-Step Verification') }}
    </div>

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf


        <div>
            <x-input-label for="password" :value="__('Verify Code')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="text"
                            name="otp"
                            required />

            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>2-Step Verification</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/corporate/sign-in.html" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/auth/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/auth/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fff;
        }

        .form-wrapper {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }
    </style>
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="center-container">
        <!--begin::Authentication - OTP Verification -->
        <div class="form-wrapper">
            <!--begin::Form-->
            <div class="text-center mb-11">
                <!--begin::Title-->
                <h1 class="text-gray-900 fw-bolder mb-3">2-Step Verification</h1>
                <!--end::Title-->
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Enter the verification code sent to your phone') }}
                </div>
            </div>
            <form class="form w-100" method="POST" action="{{ route('otp.verify') }}">
                @csrf
                <!--begin::OTP Input-->
                <div class="fv-row mb-8">
                    <input type="text" placeholder="Verify Code" name="otp" id="otp"
                        class="form-control bg-transparent" required />
                    @if ($errors->has('otp'))
                        <span class="text-danger mt-2">{{ $errors->first('otp') }}</span>
                    @endif
                </div>
                <!--end::OTP Input-->
                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Confirm</span>
                    </button>
                </div>
                <!--end::Submit button-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Authentication - OTP Verification-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/auth/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/auth/js/scripts.bundle.js') }}"></script>

    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>

