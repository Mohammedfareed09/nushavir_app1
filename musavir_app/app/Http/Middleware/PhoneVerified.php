<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PhoneVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (auth()->check() && $user->phone_verified) {
            if (!$request->is('phone-verification*')) {
                return redirect()->route('otp.form');
            }

        }

        return $next($request);
    }
}
