<!DOCTYPE html>
<html lang="en">

<head>
    <title>2-Step Verification</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!-- Global Stylesheets Bundle -->
    <link href="{{ asset('assets/auth/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/auth/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/auth/css/profile.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .countdown {
            font-size: 2rem;
            font-weight: bold;
            color: #0c0c0c;
            margin-bottom: 20px;
            text-align: center;
        }
        .resend-btn {
            display: none;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body id="kt_body" class="app-blank">
    <div class="center-container">
        <div class="form-wrapper">
            <div class="text-center mb-11">
                <h1 class="text-gray-900 fw-bolder mb-3">2-Step Verification</h1>
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Enter the verification code sent to your phone') }}
                </div>
                <div id="countdown" class="countdown"></div> <!-- Countdown timer -->
            </div>
            <form class="form w-100" method="POST" action="{{ route('otp.verify') }}">
                @csrf
                <div class="fv-row mb-8">
                    <input type="text" placeholder="Verify Code" name="otp" id="otp"
                        class="form-control bg-transparent" required />
                    @if ($errors->has('otp'))
                        <span class="text-danger mt-2">{{ $errors->first('otp') }}</span>
                    @endif
                </div>
                <div class="d-grid mb-10">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Confirm</span>
                    </button>
                </div>
            </form>
            <!-- Resend button (initially hidden) -->
            <div class="resend-btn">
                <button class="btn btn-secondary" onclick="resendOtp()">Resend OTP</button>
            </div>
        </div>
    </div>
    <!-- Global Javascript Bundle -->
    <script src="{{ asset('assets/auth/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/auth/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/auth/js/timer.js') }}"></script>

    {{-- <script>
        // Countdown timer script
        function startCountdown(duration, display) {
            var timer = duration, minutes, seconds;
            var countdownInterval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(countdownInterval);
                    display.style.display = 'none';
                    document.querySelector('.resend-btn').style.display = 'block'; // Show the resend button
                }
            }, 1000);
        }

        function resendOtp() {
            // Logic to resend OTP (could be an AJAX call or form submission)
            alert('OTP has been resent.');
            location.reload(); // Reload the page to restart the timer
        }

        window.onload = function () {
            var countdownElement = document.getElementById("countdown");
            var twoMinutes = 60 * 2; // 2 minutes in seconds
            startCountdown(twoMinutes, countdownElement);
        };
    </script> --}}
</body>

</html>
