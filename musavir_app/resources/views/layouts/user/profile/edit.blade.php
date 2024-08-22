<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/auth/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/auth/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/auth/css/profile.css') }}" rel="stylesheet" type="text/css" />

</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" class="app-default">

    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Edit Profile</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <a href="{{ route('profile.show') }}" class="btn btn-sm btn-primary align-self-center">View Profile</a>
            <!--end::Action-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" method="POST" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- Avatar -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                    <div class="col-lg-8">
                        <!-- Avatar Display -->
                        <div class="mb-3">
                            <img id="avatarDisplay" src="{{ $user->avatar_path ? asset('storage/' . $user->avatar_path) : asset('assets/media/avatars/300-1.jpg') }}" alt="Avatar" style="max-width: 200px; max-height: 200px;" />
                        </div>
                        <!-- File Upload -->
                        <div class="mb-3">
                            <input type="file" name="avatar_path" accept=".png, .jpg, .jpeg" class="form-control" />
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            <x-input-error :messages="$errors->get('avatar_path')" class="mt-2" />
                        </div>
                        <!-- Remove Avatar Button -->
                        <button type="button" class="btn btn-danger" id="removeAvatarBtn">Remove Image</button>
                        <input type="hidden" name="remove_avatar" id="removeAvatarInput" value="0">
                    </div>
                </div>

                <script>
                    document.getElementById('removeAvatarBtn').addEventListener('click', function() {
                        // Set hidden input to indicate avatar removal
                        document.getElementById('removeAvatarInput').value = '1';

                        // Hide the avatar image preview
                        document.getElementById('avatarDisplay').src = '{{ asset('assets/media/avatars/300-1.jpg') }}';

                        // Optionally disable the file input
                        document.querySelector('input[name="avatar_path"]').disabled = true;
                    });
                </script>

                <!-- Full Name -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Full Name</label>
                    <div class="col-lg-8">
                        <input type="text" name="full_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="{{ old('full_name', $user->full_name) }}" required />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                    </div>
                </div>

                <!-- Phone -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Phone Number</label>
                    <div class="col-lg-8">
                        <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{ old('phone', $user->phone) }}" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                </div>

                <!-- TC ID -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">T.C. Kimlik No</label>
                    <div class="col-lg-8">
                        <input type="text" name="tc" class="form-control form-control-lg form-control-solid" placeholder="T.C. Kimlik No" value="{{ old('tc', $user->tc) }}" />
                        <x-input-error :messages="$errors->get('tc')" class="mt-2" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Email</label>
                    <div class="col-lg-8">
                        <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{ old('email', $user->email) }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Password -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">New Password</label>
                    <div class="col-lg-8">
                        <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="New Password" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Confirm Password</label>
                    <div class="col-lg-8">
                        <input type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Confirm Password" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <!-- Actions -->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                </div>

            </form>
            <!--end::Form-->
        </div>
        <!--end::Card body-->
    </div>

    <script src="{{ asset('assets/auth/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/auth/js/scripts.bundle.js') }}"></script>
</body>
</html>
