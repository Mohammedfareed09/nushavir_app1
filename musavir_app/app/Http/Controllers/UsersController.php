<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function showLoginForm()
    {
        // return view('user.login');
        return view('layouts.user.sign-in');
    }

    public function login(Request $request)
    {
        $request->validate([
            'tc' => 'required',
            'password' => 'required',
            '_token' => 'required',
            'h-captcha-response' => ['hcaptcha'],
        ]);

        if (Auth::attempt(['tc' => $request->tc, 'password' => $request->password])) {
            session(['tc' => $request->tc]);
            return redirect()->route('phone.form');
        }

        return back()->withErrors(['tc' => 'Invalid credentials']);
    }

    public function showRegistrationForm()
    {
        return view('user.register');
    }

    public function myregister(Request $request)
    {
        Log::info('Register request data: ', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|string|unique:users',
            'tc' => 'required|string|unique:users',
        ]);
        $token = Str::random(64);
        User::create([
            'full_name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
            'tc' => $request->input('tc'),
            'token' => $token,
        ]);
        return back();
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

        $user = User::where('tc', session('tc'))->first();

        if ($user && $request->input('phone') == $user->phone) {
            session(['phone_verified' => true]);

            $user->generateVerifyCode();
            $this->sendOtp($user);

            return redirect()->route('otp.form');
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
        $user = User::where('tc', session('tc'))->first();

        if ($user && $request->input('otp') == $user->verification_code) {
            session()->forget(['tc', 'phone_verified']);
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return redirect()
            ->back()
            ->withErrors(['otp' => 'Invalid OTP']);
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login.form')->with('status', 'You have been logged out.');
    }

    private function sendOtp(User $user)
    {
        $account_sid = getenv('TWILIO_SID');
        $auth_token = getenv('TWILIO_TOKEN');
        $twilio_number = getenv('TWILIO_FROM');

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

    public function deleteUser(User $user)
{

        $user->delete();

        return back();
    }
}
