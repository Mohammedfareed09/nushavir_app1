<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class UsersController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'tc' => 'required',
            'password' => 'required',
            '_token' => 'required',
        ]);

        if (Auth::attempt(['tc' => $request->tc, 'password' => $request->password])) {
            // Store logged in user's tc in the session
            session(['tc' => $request->tc]);
            return redirect()->route('phone.form');
        }

        return back()->withErrors(['tc' => 'Invalid credentials']);
    }

    public function showPhoneForm()
    {
        if (!session()->has('tc')) {
            return redirect()->route('login.form');
        }
        return view('user.phone-verification');
    }

    public function verifyPhone(Request $request)
    {
        $request->validate(['phone' => 'required']);

        $user = Auth::user();

        if ($request->input('phone') == $user->phone) {
            session(['phone_verified' => true]);

            // Find the user by phone number
            $user = User::where('phone', $request->input('phone'))->first();

            if ($user) {
                // Generate and send the verification code
                $user->generateVerifyCode();
                $this->sendOtp($user);

                return redirect()->route('otp.form');
            } else {
                return back()->withErrors(['phone' => 'Phone number not found.']);
            }
        }

        return back()->withErrors(['phone' => 'Invalid phone number.']);
    }

    public function showOtpForm()
    {
        if (!session()->has('phone_verified')) {
            return redirect()->route('phone.form');
        }
        return view('user.two-factor-verification');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);
        $user = auth()->user();

        if ($request->input('otp') == $user->verification_code) {
            // OTP is valid, clear session data and proceed
            session()->forget(['tc', 'phone_verified']);
            return redirect()->route('dashboard');
        }

        return redirect()
            ->back()
            ->withErrors(['otp' => 'Invalid OTP']);
    }

    private function sendOtp(User $user)
    {
        $account_sid = getenv('TWILIO_SID');
        $auth_token = getenv('TWILIO_TOKEN');
        $twilio_number = getenv('TWILIO_FROM');

        // Log the credentials to ensure they are being read correctly
        Log::info('TWILIO_SID: ' . $account_sid);
        Log::info('TWILIO_TOKEN: ' . $auth_token);
        Log::info('TWILIO_FROM: ' . $twilio_number);

        if (!$account_sid || !$auth_token || !$twilio_number) {
            throw new \Exception('Twilio credentials are not set');
        }

        $message = 'The Verify code is ' . $user->verification_code;

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($user->phone, [
            'from' => $twilio_number,
            'body' => $message,
        ]);
    }
}
