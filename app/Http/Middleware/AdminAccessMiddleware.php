<?php
// app/Http/Middleware/AdminAccessMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;

class AdminAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Allow admin users to access routes without email verification
        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail() && !$user->isAdmin()) {
            return redirect('email/verify');
        }

        return $next($request);
    }
}
