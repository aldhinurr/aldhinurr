<?php

namespace App;

use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LayananGambarController;
use App\Http\Controllers\RepairServiceController;
use App\Http\Controllers\ReportServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\WebsiteController;
use App\Models\RepairService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


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
Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');
Route::get('/layanan', [WebsiteController::class, 'layanan'])->name('layanan.page');
Route::get('/layanan/unit', [WebsiteController::class, 'getUnitPengelola'])->name('unit.pengelola');
Route::get('/sewa-layanan', [WebsiteController::class, 'sewa'])->name('sewa.page');
Route::get('/resource-sharing', [WebsiteController::class, 'resource'])->name('resource.page');
Route::get('/rooms', [WebsiteController::class, 'rooms'])->name('website.rooms');
Route::get('/rooms/{layanan:id}/detail', [WebsiteController::class, 'show_room'])->name('website.room.show');
Route::get('/rooms-sewa', [WebsiteController::class, 'rooms_sewa'])->name('website.rooms_sewa');
Route::get('/rooms-resource', [WebsiteController::class, 'rooms_resource'])->name('website.rooms_resource');
Route::get('/cars', [WebsiteController::class, 'cars'])->name('website.cars');
Route::get('/cars-sewa', [WebsiteController::class, 'cars_sewa'])->name('website.cars_sewa');
Route::get('/cars-resource', [WebsiteController::class, 'cars_resource'])->name('website.cars_resource');
Route::get('/cars/{layanan:id}/detail', [WebsiteController::class, 'show_car'])->name('website.car.show');
Route::get('/rku', [WebsiteController::class, 'rku'])->name('website.rku');
Route::get('/rku-sewa', [WebsiteController::class, 'rku_sewa'])->name('website.rku_sewa');
Route::get('/rku-resource', [WebsiteController::class, 'rku_resource'])->name('website.rku_resource');
Route::get('/rku/{layanan:id}/detail', [WebsiteController::class, 'show_rku'])->name('website.rku.show');
Route::get('/rumah', [WebsiteController::class, 'rumah'])->name('website.rumah');
Route::get('/rumah-sewa', [WebsiteController::class, 'rumah_sewa'])->name('website.rumah_sewa');
Route::get('/rumah-resource', [WebsiteController::class, 'rumah_resource'])->name('website.rumah_resource');
Route::get('/rumah/{layanan:id}/detail', [WebsiteController::class, 'show_rumah'])->name('website.rumah.show');
Route::get('/selasar', [WebsiteController::class, 'selasar'])->name('website.selasar');
Route::get('/selasar-sewa', [WebsiteController::class, 'selasar_sewa'])->name('website.selasar_sewa');
Route::get('/selasar-resource', [WebsiteController::class, 'selasar_resource'])->name('website.selasar_resource');
Route::get('/selasar/{layanan:id}/detail', [WebsiteController::class, 'show_selasar'])->name('website.selasar.show');
Route::get('/lapangan', [WebsiteController::class, 'lapangan'])->name('website.lapangan');
Route::get('/lapangan-sewa', [WebsiteController::class, 'lapangan_sewa'])->name('website.lapangan_sewa');
Route::get('/lapangan-resource', [WebsiteController::class, 'lapangan_resource'])->name('website.lapangan_resource');
Route::get('/lapangan/{layanan:id}/detail', [WebsiteController::class, 'show_lapangan'])->name('website.lapangan.show');
Route::get('/peralatan', [WebsiteController::class, 'peralatan'])->name('website.peralatan');
Route::get('/peralatan-sewa', [WebsiteController::class, 'peralatan_sewa'])->name('website.peralatan_sewa');
Route::get('/peralatan-resource', [WebsiteController::class, 'peralatan_resource'])->name('website.peralatan_resource');
Route::get('/peralatan/{layanan:id}/detail', [WebsiteController::class, 'show_peralatan'])->name('website.peralatan.show');
Route::get('/report', [WebsiteController::class, 'report'])->name('website.report');
Route::get('/repair', [WebsiteController::class, 'repair'])->name('website.repair');
Route::get('/status', [WebsiteController::class, 'status'])->name('website.status');
Route::get('/status/calendar', [WebsiteController::class, 'status_calendar'])->name('website.status.calendar');
Route::get('/status/report', [WebsiteController::class, 'status_report'])->name('website.status.report');
Route::get('/status/report/calendar', [WebsiteController::class, 'status_report_calendar'])->name('website.status.report.calendar');
Route::get('/status/repair', [WebsiteController::class, 'status_repair'])->name('website.status.repair');
Route::get('/status/repair/calendar', [WebsiteController::class, 'status_repair_calendar'])->name('website.status.repair.calendar');
Route::get('/facilities', [WebsiteController::class, 'facilities'])->name('website.facilities');
Route::get('/buildings', [WebsiteController::class, 'buildings'])->name('website.buildings');
Route::get('/floors', [WebsiteController::class, 'floors'])->name('website.floors');
Route::get('/barang', [BarangController::class, 'barang'])->name('website.barang');
Route::get('/uji-lab', [WebsiteController::class, 'lab'])->name('website.lab');

Route::post('/reservation/{reservation_id}/detail/mark-as-read', [ReservationController::class, 'markAsRead'])->name('markAsRead');

Route::get('/reservation/check', [ReservationController::class, 'check'])->name('website.reservation.check');
Route::get('/report/{reportService:id}/detail', [ReportServiceController::class, 'detail'])->name('website.report.show');
Route::get('/repair/{repairService:id}/detail', [RepairServiceController::class, 'detail'])->name('website.repair.show');

Route::middleware('auth')->group(function () {
    // website
    Route::post('/reservation', [ReservationController::class, 'store'])->name('website.reservation');
    Route::get('/reservation/{id}/verifikasi', [ReservationController::class, 'verifikasi'])->name('reservation.verifikasi');
    Route::get('/reservation/{reservation:id}/detail', [ReservationController::class, 'detail'])->name('website.reservation.show');
    Route::post('/reservation/{reservation:id}/store-eoffice', [ReservationController::class, 'storeEoffice'])->name('store.eoffice');
    Route::post('/reservation/{reservation:id}/receipt/upload', [ReservationController::class, 'upload_receipt'])->name('website.reservation.receipt.upload');
    Route::post('/reservation/{reservation:id}/surat_permohonan/upload', [ReservationController::class, 'upload_permohonan'])->name('website.reservation.permohonan.upload');

    Route::post('/report/store', [ReportServiceController::class, 'store'])->name('website.report.store');
    Route::post('/repair/store', [RepairServiceController::class, 'store'])->name('website.repair.store');
    Route::get('/repair/{repairService:id}/edit', [RepairServiceController::class, 'edit'])->name('website.repair.edit');
    Route::put('/repair/{repairService:id}/update', [RepairServiceController::class, 'update'])->name('website.repair.update');

    // Admin
    Route::prefix('admin')->group(function () {
        Route::get('', function () {
            $floorController = new FloorController();
            $reservationController = new ReservationController();
        
            // Memanggil method getFloorsData dari FloorController
            $floorsData = $floorController->getFloorsData();
        
            // Memanggil method admin_status dari FloorController
            $floors = $floorController->admin_status();

            $floorsSudahKategoriData = $floorController->getFloorsSudahKategori();
        
            // Memanggil method admin_status dari ReservationController
            $layanansAndReservations = $reservationController->admin_status();

            $request = request();
            $showChart = $reservationController->showChart($request);
            $showBar = $reservationController->showBar($request);
            $tableBar = $reservationController->tableBar($request);
        
            // Menggabungkan data dari dua controller menjadi satu array asosiatif
            $data = [
                'floors' => $floors,
                'floorsData' => $floorsData,
                'layanans' => $layanansAndReservations['layanans'],
                'reservations' => $layanansAndReservations['reservations'],
                'chart' => $showChart['chart'],
                'bar' => $showBar['bar'],
                'tableBar' => $tableBar['tableBar'],
                'floorsSudahKategoriData' => $floorsSudahKategoriData
            ];
        
            // Menampilkan view dengan melewatkan data dari kedua controller
            return view('pages.index', $data);
        })->name('admin.index');

        Route::get('/floor-data/{unit}', [FloorController::class, 'getFloorDetail']);

        Route::get('/sudah-kategori/{kategori_ruang}', [FloorController::class, 'getSudahKategoriDetail']);
    
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
            Route::post('/find', [LayananController::class, 'find'])->name('layanan.find');
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
            Route::get('/sewa', [ReservationController::class, 'indexSewa'])->name('reservation.indexSewa');
            Route::get('/resource', [ReservationController::class, 'indexResource'])->name('reservation.indexResource');
            Route::get('/chart', [ReservationController::class, 'showChart'])->name('reservations.chart');
            Route::get('/bar', [ReservationController::class, 'showBar'])->name('reservations.bar');
            Route::get('/bar/table', [ReservationController::class, 'tableBar'])->name('reservations.tableBar');
            Route::get('/chart/export', [ReservationController::class, 'exportChart'])->name('chart.export');
            Route::get('/bar/export', [ReservationController::class, 'exportBar'])->name('bar.export');
            // Route::get('/reservation/{id}/verifikasi', [ReservationController::class, 'verifikasi'])->name('reservation.verifikasi');
            Route::get('/{reservation:id}/detail', [ReservationController::class, 'show'])->name('reservation.show');
            Route::post('/{reservation:id}/approve', [ReservationController::class, 'approve'])->name('reservation.approve');
            Route::post('/{reservation:id}/review', [ReservationController::class, 'review'])->name('reservation.review');
            Route::post('/{reservation:id}/move', [ReservationController::class, 'approve_move'])->name('reservation.move');
            Route::post('/{reservation:id}/reject', [ReservationController::class, 'reject'])->name('reservation.reject');
            Route::post('/{reservation:id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
        });
    
        // report pages
        Route::prefix('report')->group(function () {
            Route::get('', [ReportServiceController::class, 'index'])->name('report.index');
            Route::get('/{reportService:id}/detail', [ReportServiceController::class, 'show'])->name('report.show');
            Route::put('/{reportService:id}/update', [ReportServiceController::class, 'update'])->name('report.update');
        });
    
        // building pages
        Route::prefix('building')->group(function () {
            Route::get('', [BuildingController::class, 'index'])->name('building.index');
            Route::get('/create', [BuildingController::class, 'create'])->name('building.create');
            Route::post('/store', [BuildingController::class, 'store'])->name('building.store');
            Route::get('/{building:id}/detail', [BuildingController::class, 'show'])->name('building.show');
            Route::get('/{building:id}/edit', [BuildingController::class, 'edit'])->name('building.edit');
            Route::put('/{building:id}/update', [BuildingController::class, 'update'])->name('building.update');
            Route::get('/{building:id}/floors', [FloorController::class, 'index'])->name('building.floors');
        });
    
        // floor pages
        Route::prefix('floor')->group(function () {
            Route::get('', [FloorController::class, 'building'])->name('floor.building');
            // Route::get('/create/{building:id}', [FloorController::class, 'create'])->name('floor.create');
            Route::get('/create', [FloorController::class, 'create'])->name('floor.create'); //edited 280324
            Route::post('/store', [FloorController::class, 'store'])->name('floor.store');
            Route::get('/{floor:id}/detail', [FloorController::class, 'show'])->name('floor.show');
            Route::get('/{floor:id}/edit', [FloorController::class, 'edit'])->name('floor.edit');
            Route::put('/{floor:id}/update', [FloorController::class, 'update'])->name('floor.update');
            Route::delete('/{floor:id}/delete', [FloorController::class, 'destroy'])->name('floor.delete');
            Route::get('/data-luas', [FloorController::class, 'ExportDataLuas'])->name('data.luas');
        });
    
        // repair pages
        Route::prefix('repair')->group(function () {
            Route::get('', [RepairServiceController::class, 'index'])->name('repair.index');
            Route::get('/{repairService:id}/detail', [RepairServiceController::class, 'show'])->name('repair.show');
            Route::post('/{repairService:id}/approve', [RepairServiceController::class, 'approve'])->name('repair.approve');
            Route::post('/{repairService:id}/reject', [RepairServiceController::class, 'reject'])->name('repair.reject');
            Route::post('/{repairService:id}/review', [RepairServiceController::class, 'review'])->name('repair.review');
        });
        
        // barang pages
        Route::prefix('barang')->group(function () {
            Route::get('', [BarangController::class, 'index'])->name('barang.index');
            Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
            Route::post('/store', [BarangController::class, 'store'])->name('barang.store');
            Route::get('/{barang:id}/detail', [BarangController::class, 'show'])->name('barang.show');
            Route::get('/{barang:id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
            Route::put('/{barang:id}/update', [BarangController::class, 'update'])->name('barang.update');
            Route::delete('/{barang:id}/delete', [BarangController::class, 'destroy'])->name('barang.delete');
        });
    });    
});

Route::resource('users', UsersController::class);

require __DIR__ . '/auth.php';
