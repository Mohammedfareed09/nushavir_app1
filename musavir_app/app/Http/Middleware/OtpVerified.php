<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (auth()->check() && $user->otp_verified) {
            if (!$request->is('verification_code*')) {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
