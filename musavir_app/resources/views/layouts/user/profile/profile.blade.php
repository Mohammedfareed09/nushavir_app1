<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Profile Details</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/auth/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/auth/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" class="app-default">

    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Profile Details</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary align-self-center">Edit Profile</a>
            <!--end::Action-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <div class="row mb-7 align-items-center">
                <!--begin::Avatar-->
                <div class="col-lg-4 text-center">
                    <div class="mb-3">
                        <img id="avatarDisplay" src="{{ $user->avatar_path ? asset('storage/' . $user->avatar_path) : asset('assets/media/avatars/300-1.jpg') }}" alt="Avatar" style="max-width: 200px; max-height: 200px;" />
                    </div>
                </div>
                <!--end::Avatar-->
                <!--begin::Profile details-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ $user->full_name }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-semibold text-gray-800 fs-6">{{ $user->email }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Phone Number</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 d-flex align-items-center">
                            <span class="fw-bold fs-6 text-gray-800 me-2">{{ $user->phone }}</span>
                            <span class="badge badge-success">Verified</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">TC</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ $user->tc }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Profile details-->
            </div>
        </div>
        <!--end::Card body-->
    </div>

    <!--begin::Scripts-->
    <script src="{{ asset('assets/auth/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/auth/js/scripts.bundle.js') }}"></script>
    <!--end::Scripts-->

</body>
<!--end::Body-->

</html>
