<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisteredUserController;
use SSO\SSO;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

class SSOLoginController extends Controller
{

//-------------- LOGIN SSO MICROSOFT AZURE-------------

    public function redirectToAzure()
    {
        return Socialite::driver('azure')->redirect();
    }

    public function handleAzureCallback()
    {
        $user = Socialite::driver('azure')->user();
    //----------------------ALLOW ACCESS------------------------------
        // $userEmail = $user->email;
        // $allowedEmails = [
        //     'dummysp1@itb.ac.id',
        //     'bambang.heryanto@itb.ac.id',
        //     'regiherdian95@itb.ac.id',
        //     'adit@itb.ac.id',
        //     'aldhinurr@itb.ac.id',
        // ];
        // if (!in_array($userEmail, $allowedEmails)) {
        //     return redirect('/')
        //     ->with('alert', 'Login Gagal, masih dalam pengembangan ');
        // }
    //-----------------------------------------------------------------

         if (strpos($user->email, '@mahasiswa.itb.ac.id') !== false
            || strpos($user->email, '@std.stei.itb.ac.id') !== false
            || strpos($user->email, '@students.itb.ac.id') !== false) {
            return redirect(RouteServiceProvider::HOME)
                ->with('alert', '<strong style="color:red;">Login Gagal 
                (Login ITB Account di website e-Facility tidak diperuntukkan untuk Mahasiswa).</strong> ');
        } else {

        // Cek apakah email sudah ada di tabel users
        $authUser = User::where('email', $user->email)->first();

        if (!$authUser) {
            $authUser = new User;
            $authUser->email = $user->email;
            $authUser->itb_unit = $user->attributes['unit'];
            $authUser->itb_status = $user->attributes['status'];
            $authUser->no_telp = $user->attributes['telp'];

            // Memeriksa apakah ada spasi dalam nama pengguna
            if (strpos($user->name, ' ') !== false) {
                // Jika ada spasi, pisahkan nama pertama dan terakhir
                $nameParts = explode(' ', $user->name, 2);
                $authUser->first_name = $nameParts[0];
                $authUser->last_name = $nameParts[1];
            } else {
                // Jika tidak ada spasi, gunakan seluruh nama sebagai first_name
                $authUser->first_name = $user->name;
                $authUser->last_name = ''; // Kosongkan last_name
            }

            if ($authUser->itb_unit == "Direktorat ITB Kampus Jatinangor") {
                $authUser->location = "JATINANGOR";
            } elseif ($authUser->itb_unit == "Direktorat ITB Kampus Cirebon") {
                $authUser->location = "CIREBON";
            } elseif ($authUser->itb_unit == "Direktorat ITB Kampus Jakarta") {
                $authUser->location = "JAKARTA";
            } else {
                $authUser->location = "GANESHA";
            }

            // Anda juga dapat menambahkan logika lain untuk mengisi kolom lain yang diperlukan
            $authUser->save();
        } else {
            // Jika pengguna sudah ada, update kolom jika perlu
            $updated = false;

            if (is_null($authUser->itb_unit)) {
                $authUser->itb_unit = $user->attributes['unit'];
                $updated = true;
            }
            if (is_null($authUser->itb_status)) {
                $authUser->itb_status = $user->attributes['status'];
                $updated = true;
            }
            if ($authUser->no_telp != $user->attributes['telp']) {
                $authUser->no_telp = $user->attributes['telp'];
                $updated = true;
            }

            if ($updated) {
                $authUser->save();
            }
        }
    }
        Auth::login($authUser, true);

        session([
            'azure_access_token' => $user->token,
            'azure_id_token' => $user->id_token
        ]);

        return redirect(RouteServiceProvider::HOME);
    }

    public function logoutAzure(Request $request) 
    {
        Auth::guard()->logout();
        $request->session()->flush();
        $azureLogoutUrl = Socialite::driver('azure')->getLogoutUrl(route('website.index'));
        return redirect($azureLogoutUrl);
    }


// ------------- LOGIN SSO ITB ristek ------------

    public function loginSSO(Request $request) {
        
        Auth::logout();
        // Authenticate the user
        SSO::authenticate();
        // If authenticated
        $user = SSO::getUser();

        // check if status is not mahasiswa
        if ($user->status === 'Mahasiswa') {
            // Redirect to home with an alert
            return redirect(RouteServiceProvider::HOME)
            ->with('alert', '<strong style="color:red;">Login Gagal - Mohon maaf, login ITB Account di website E-Facility tidak diperuntukkan untuk Mahasiswa.</strong> ');
        }else{
            // Check SSO email availability
            $existingUser = User::where('email', $user->ITBmail)->first();

                if (!$existingUser) {
                $existingUser = new User;
                $existingUser->email = $user->ITBmail;
                $existingUser->itb_status = $user->status;
                $existingUser->itb_unit = $user->unit;

                // Memeriksa apakah ada spasi dalam nama pengguna
                if (strpos($user->name, ' ') !== false) {
                    // Jika ada spasi, pisahkan nama pertama dan terakhir
                    $nameParts = explode(' ', $user->name, 2);
                    $existingUser->first_name = $nameParts[0];
                    $existingUser->last_name = $nameParts[1];
                } else {
                    // Jika tidak ada spasi, gunakan seluruh nama sebagai first_name
                    $existingUser->first_name = $user->name;
                    $existingUser->last_name = ''; // Kosongkan last_name
                }
                $existingUser->save();
            }

            Auth::loginUsingId($existingUser->id);
            session(['last_activity' => time()]);
            return redirect(RouteServiceProvider::HOME);
        }
    }
    
    public function registerSSO()
    {
        if (!SSO::check())
            SSO::authenticate();
        
        $user = SSO::getUser();
    
        return view('auth/registerSSO', [
            'user' => $user
        ]);
    }

    public function logoutSSO(Request $request)
    {
        Auth::guard('web')->logout();
        $url = 'https://e-facility.itb.ac.id/';
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        SSO::logout($url);
    }
    
}