<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Session\Store;

class AutoLogout
{
    protected $auth;
    protected $session;

    public function __construct(Auth $auth, Store $session)
    {
        $this->auth = $auth;
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        if (! $this->auth->check()) {
            return $next($request);
        }
    
        $user = $this->auth->user();
        $lastActivity = $this->session->get('lastActivity');
    
        if ($lastActivity && time() - $lastActivity > 900) {
            $this->auth->logout(); // Melakukan logout
            $this->session->forget('lastActivity');
            // Mengubah redirect URL dan menyertakan pesan alert
            return redirect('https://e-facility.itb.ac.id/login-page')
            ->with('alert', '<a style="color:red;">Sesi telah habis, silahkan login kembali.</a>');
        }        
    
        $this->session->put('lastActivity', time());
    
        return $next($request);
    }
    
}
