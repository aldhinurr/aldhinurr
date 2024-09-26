<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserActivity
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $user->last_activity = now();
            $user->save();
        }

        return $next($request);
    }
}