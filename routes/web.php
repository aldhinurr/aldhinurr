<?php

namespace App;

use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LayananGambarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('index');
});

$menu = theme()->getMenu();
array_walk($menu, function ($val) {
    if (isset($val['path'])) {
        $route = Route::get($val['path'], [PagesController::class, 'index']);

        // Exclude documentation from auth middleware
        if (!Str::contains($val['path'], 'documentation')) {
            $route->middleware('auth');
        }
    }
});

// Documentations pages
Route::prefix('documentation')->group(function () {
    Route::get('getting-started/references', [ReferencesController::class, 'index']);
    Route::get('getting-started/changelog', [PagesController::class, 'index']);
});

Route::middleware('auth')->group(function () {
    // Anggaran pages
    Route::prefix('anggaran')->group(function () {
        Route::get('', [AnggaranController::class, 'index'])->name('anggaran.index');
        Route::get('/create', [AnggaranController::class, 'create'])->name('anggaran.create');
    });

    // Layanan pagesac
    Route::prefix('layanan')->group(function () {
        Route::get('', [LayananController::class, 'index'])->name('layanan.index');
        Route::get('/create', [LayananController::class, 'create'])->name('layanan.create');
        Route::post('/store', [LayananController::class, 'store'])->name('layanan.store');
        Route::get('/{layanan:id}/detail', [LayananController::class, 'show'])->name('layanan.show');
        Route::get('/{layanan:id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
        Route::put('/{layanan:id}/update', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/{layanan:id}/delete', [LayananController::class, 'destroy'])->name('layanan.delete');
        Route::post('/gambar/upload', [LayananGambarController::class, 'upload'])->name('layanan-gambar.upload');
        Route::post('/gambar/delete', [LayananGambarController::class, 'delete'])->name('layanan-gambar.delete');
    });

    // Account pages
    Route::prefix('account')->group(function () {
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::put('settings/email', [SettingsController::class, 'changeEmail'])->name('settings.changeEmail');
        Route::put('settings/password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
    });

    // Logs pages
    Route::prefix('log')->name('log.')->group(function () {
        Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
        Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
    });
});

Route::resource('users', UsersController::class);

/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__ . '/auth.php';
