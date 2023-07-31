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
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LayananGambarController;
use App\Http\Controllers\ReportServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\WebsiteController;
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


// web
Route::get('/', [WebsiteController::class, 'index'])->name('website.index');
Route::get('/rooms', [WebsiteController::class, 'rooms'])->name('website.rooms');
Route::get('/rooms/{layanan:id}/detail', [WebsiteController::class, 'show_room'])->name('website.room.show');
Route::get('/cars', [WebsiteController::class, 'cars'])->name('website.cars');
Route::get('/report', [WebsiteController::class, 'report'])->name('website.report');
Route::get('/status', [WebsiteController::class, 'status'])->name('website.status');
Route::get('/status/calendar', [WebsiteController::class, 'status_calendar'])->name('website.status.calendar');
Route::get('/facilities', [WebsiteController::class, 'facilities'])->name('website.facilities');

Route::get('/reservation/check', [ReservationController::class, 'check'])->name('website.reservation.check');
Route::get('/report/{reportService:id}/detail', [ReportServiceController::class, 'detail'])->name('website.report.show');

Route::middleware('auth')->group(function () {
    // website
    Route::post('/reservation', [ReservationController::class, 'store'])->name('website.reservation');
    Route::get('/reservation/{reservation:id}/detail', [ReservationController::class, 'detail'])->name('website.reservation.show');
    Route::post('/reservation/{reservation:id}/receipt/upload', [ReservationController::class, 'upload_receipt'])->name('website.reservation.receipt.upload');

    Route::post('/report/store', [ReportServiceController::class, 'store'])->name('website.report.store');

    // admin
    Route::prefix('admin')->group(function () {
        Route::get('', function () {
            return view('pages.index');
        })->name('admin.index');

        // Layanan pages
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

        // Facilities pages
        Route::prefix('facility')->group(function () {
            Route::get('', [FacilityController::class, 'index'])->name('facility.index');
            Route::get('/create', [FacilityController::class, 'create'])->name('facility.create');
            Route::post('/store', [FacilityController::class, 'store'])->name('facility.store');
            Route::get('/{facility:id}/detail', [FacilityController::class, 'show'])->name('facility.show');
            Route::get('/{facility:id}/edit', [FacilityController::class, 'edit'])->name('facility.edit');
            Route::put('/{facility:id}/update', [FacilityController::class, 'update'])->name('facility.update');
            Route::delete('/{facility:id}/delete', [FacilityController::class, 'destroy'])->name('facility.delete');
            Route::post('/getFacilities', [FacilityController::class, 'getFacilities'])->name('facility.getFacilities');
        });

        // reservation pages
        Route::prefix('reservation')->group(function () {
            Route::get('', [ReservationController::class, 'index'])->name('reservation.index');
            Route::get('/{reservation:id}/detail', [ReservationController::class, 'show'])->name('reservation.show');
            Route::post('/{reservation:id}/approve', [ReservationController::class, 'approve'])->name('reservation.approve');
            Route::post('/{reservation:id}/reject', [ReservationController::class, 'reject'])->name('reservation.reject');
        });
    });
});

Route::resource('users', UsersController::class);

/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__ . '/auth.php';
