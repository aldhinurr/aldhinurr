<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login-page');
        }
    }

    // public function handle($request, Closure $next, ...$guards)
    // {
    //     $this->authenticate($request, $guards);

    //     // Perbarui waktu aktivitas pengguna saat ini
    //     if (Auth::check()) {
    //         $user = Auth::user();
    //         $user->last_activity = now();
    //         $user->save();
    //     }

    //     return $next($request);
    // }

}
