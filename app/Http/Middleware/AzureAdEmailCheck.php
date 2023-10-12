<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AzureAdEmailCheck
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $email = $user->email;

            // Cek apakah email ada di tabel users
            $existingUser = DB::table('users')->where('email', $email)->first();

            if ($existingUser) {
                // Email ditemukan di tabel users, lanjutkan
                return $next($request);
            } else {
                // Email tidak ditemukan, logout pengguna
                Auth::logout();
            }
        }

        // Redirect ke halaman login
        return redirect('/login-page');
    }
}