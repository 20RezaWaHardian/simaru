<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('manajement')->group(function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/roles', 'index');
            Route::get('/roles/create', 'create');
            Route::post('/roles/{id}/update', 'update')->name('roles.update');
            Route::get('/roles/{id}/edit', 'edit');
            Route::post('/roles/store', 'store')->name('roles.store');
            Route::delete('/roles/{id}/delete', 'destroy');

            //Set Hak Akses
            // Route::get('/roles/{id}/set-hak-akses', 'setHakAkses');
            // Route::post('/roles/{id}/hak-akses-syc', 'sycHakAkses')->name('hakAkses.sync');

            //Set Permission
            Route::get('/roles/{id}/set-permission', 'setPermission');
            Route::post('/roles/{id}/permission-syc', 'sycPermission')->name('permisssion.sync');
         });

         /*Batasn Route Role dan Permission*/

        Route::controller(PermissionController::class)->group(function () {
            Route::get('/permissions', 'index');
            Route::get('/permissions/create', 'create');
            Route::post('/permissions/{id}/update', 'update')->name('permissions.update');
            Route::get('/permissions/{id}/edit', 'edit');
            Route::post('/permissions/store', 'store')->name('permissions.store');
            Route::delete('/permissions/{id}/delete', 'destroy');
            // Route::get('/role', 'index')->middleware('can:read-role');
        });

        /*Batasn Route Permission dan User*/

        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index');
            Route::get('/users/create', 'create');
            Route::get('/users/login', 'login');
            Route::get('/users/{id}/login', 'loginAs');
            Route::post('/users/{id}/update', 'update')->name('users.update');
            Route::get('/users/{id}/edit', 'edit');
            Route::post('/users/store', 'store')->name('users.store');
            Route::delete('/users/{id}/delete', 'destroy');
        });

        /*Batasn Route User dan Navigation*/

        Route::controller(NavigationController::class)->group(function () {
            Route::get('/menus', 'index');
            Route::get('/menus/create', 'create');
            Route::post('/menus/{id}/update', 'update')->name('menus.update');
            Route::get('/menus/{id}/edit', 'edit');
            Route::post('/menus/store', 'store')->name('menus.store');
            Route::delete('/menus/{id}/delete', 'destroy');
        });

    });

    Route::prefix('master-data')->group(function () {
        Route::controller(LokasiController::class)->group(function () {
            Route::get('/lokasi', 'index');
            Route::get('/lokasi/create', 'create');
            Route::post('/lokasi/{id}/update', 'update')->name('lokasi.update');
            Route::get('/lokasi/{id}/edit', 'edit');
            Route::post('/lokasi/store', 'store')->name('lokasi.store');
            Route::delete('/lokasi/{id}/delete', 'destroy');
         });

        Route::controller(GedungController::class)->group(function () {
            Route::get('/gedung', 'index');
            Route::get('/gedung/create', 'create');
            Route::post('/gedung/{id}/update', 'update')->name('gedung.update');
            Route::get('/gedung/{id}/edit', 'edit');
            Route::post('/gedung/store', 'store')->name('gedung.store');
            Route::delete('/gedung/{id}/delete', 'destroy');
         });

        Route::controller(JenisRuanganController::class)->group(function () {
            Route::get('/jenis-ruangan', 'index');
            Route::get('/jenis-ruangan/create', 'create');
            Route::post('/jenis-ruangan/{id}/update', 'update')->name('jenisR.update');
            Route::get('/jenis-ruangan/{id}/edit', 'edit');
            Route::post('/jenis-ruangan/store', 'store')->name('jenisR.store');
            Route::delete('/jenis-ruangan/{id}/delete', 'destroy');
         });

        Route::controller(RuanganController::class)->group(function () {
            Route::get('/ruangan', 'index');
            Route::get('/ruangan/create', 'create');
            Route::post('/ruangan/{id}/update', 'update')->name('ruangan.update');
            Route::get('/ruangan/{id}/edit', 'edit');
            Route::post('/ruangan/store', 'store')->name('ruangan.store');
            Route::delete('/ruangan/{id}/delete', 'destroy');
         });
    });

    Route::prefix('manajement-ruangan')->group(function () {
        Route::controller(PeminjamanController::class)->group(function () {
            Route::get('/peminjaman', 'index')->name('peminjaman.index');
            Route::post('/peminjaman/store', 'store')->name('peminjaman.store');
         });

        Route::controller(PengajuanController::class)->group(function () {
            Route::get('/pengajuan', 'index')->name('pengajuan.index');
            Route::post('/pengajuan/{id}/update', 'update')->name('pengajuan.update');
            Route::get('/pengajuan/{id}/edit', 'edit');
            Route::get('/pengajuan/{id}/accept', 'accept')->name('pengajuan.accept');
            Route::get('/pengajuan/{id}/disaccept', 'disaccept')->name('pengajuan.disaccept');
            Route::delete('/pengajuan/{id}/delete', 'destroy');
         });

         Route::controller(BookingController::class)->group(function () {
            Route::get('/booking', 'index')->name('booking.index');
            Route::post('/booking/{id}/update', 'update')->name('booking.update');
            Route::get('/booking/{id}/edit', 'edit');
            Route::get('/booking/{id}/accept', 'accept')->name('booking.accept');
            Route::get('/booking/{id}/disaccept', 'disaccept')->name('booking.disaccept');
            Route::delete('/booking/{id}/delete', 'destroy');
         });

         Route::controller(AlokasiController::class)->group(function () {
            Route::get('/alokasi-ruangan', 'index')->name('alokasi-ruangan.index');;
            Route::get('/alokasi-ruangan/{id_prodi}/alokasi', 'create')->name('alokasi-ruangan.create');
            Route::post('/alokasi-ruangan/store', 'store')->name('alokasi-ruangan.store');
            Route::get('/alokasi-ruangan/{id}/show', 'show')->name('alokasi-ruangan.show');
         });
    });








});

Route::get('logout', function(){
    Auth::logout();

    return redirect('/');
});

require __DIR__.'/auth.php';
