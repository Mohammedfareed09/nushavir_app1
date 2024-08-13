<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>Register</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dark mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
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
        <!--begin::Authentication - Register -->
        <div class="form-wrapper">
            <!--begin::Form-->
            <div class="text-center mb-11">
                <!--begin::Title-->
                <h1 class="text-gray-900 fw-bolder mb-3">Register</h1>
                <!--end::Title-->
            </div>
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form w-100" method="POST" action="{{ route('myregister') }}">
                @csrf

                <div class="fv-row mb-8">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control bg-transparent" required>
                </div>

                <div class="fv-row mb-8">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control bg-transparent" required>
                </div>

                <div class="fv-row mb-8">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control bg-transparent" required>
                </div>

                <div class="fv-row mb-8">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-transparent" required>
                </div>

                <div class="fv-row mb-8">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control bg-transparent" required>
                </div>

                <div class="fv-row mb-8">
                    <label for="tc" class="form-label">TC</label>
                    <input type="text" name="tc" id="tc" value="{{ old('tc') }}" class="form-control bg-transparent" required>
                </div>

                <div class="d-grid mb-10">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Register</span>
                    </button>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Authentication - Register-->
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
