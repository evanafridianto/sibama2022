<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\R24Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JalanController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\DrainaseController;
use App\Http\Controllers\GenanganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', [AuthenticatedSessionController::class, 'create']);


Route::group(['middleware' => ['auth']], function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // map
    Route::get('/peta', [MapController::class, 'index'])->name('map');
    Route::get('/peta/drainase/{tahun}', [MapController::class, 'drainase']);

    Route::group(['prefix' => 'datamaster'], function () {
        // drainase
        Route::controller(DrainaseController::class)->group(function () {
            Route::get('drainase/{tahun}', 'index')->whereIn('tahun', ['2020', '2021', '2022'])->name('drainase.index');
            Route::get('drainase/{tahun}/create', 'create')->whereIn('tahun', ['2020', '2021', '2022'])->name('drainase.create');
            Route::get('drainase/{tahun}/edit/{id}', 'edit')->whereIn('tahun', ['2020', '2021', '2022'])->name('drainase.edit');
            Route::post('drainase/{tahun}/store', 'store')->whereIn('tahun', ['2020', '2021', '2022']);
            Route::delete('drainase/{tahun}/destroy/{id}', 'destroy')->whereIn('tahun', ['2020', '2021', '2022']);
            Route::get('drainase/{tahun}/export', 'export')->whereIn('tahun', ['2020', '2021', '2022'])->name('drainase.export');
            Route::post('drainase/{tahun}/import', 'import')->whereIn('tahun', ['2020', '2021', '2022']);
        });
        // genangan
        Route::controller(GenanganController::class)->group(function () {
            Route::get('genangan', 'index')->name('genangan.index');
            Route::get('genangan/create', 'create')->name('genangan.create');
            Route::get('genangan/edit/{id}', 'edit')->name('genangan.edit');
            Route::post('genangan/store', 'store');
            Route::delete('genangan/destroy/{id}', 'destroy');
            Route::post('genangan/import', 'import');
            Route::get('genangan/export', 'export')->name('genangan.export');
        });
        // jalan
        Route::controller(JalanController::class)->group(function () {
            Route::get('jalan', 'index')->name('jalan.index');
            Route::get('jalan/create', 'create')->name('jalan.create');
            Route::get('jalan/edit/{id}', 'edit')->name('jalan.edit');
            Route::post('jalan/store', 'store');
            Route::delete('jalan/destroy/{id}', 'destroy');
            Route::post('jalan/import', 'import');
            Route::get('jalan/export', 'export')->name('jalan.export');
        });
        // kelurahan
        Route::controller(KelurahanController::class)->group(function () {
            Route::get('kelurahan', 'index')->name('kelurahan.index');
            Route::get('kelurahan/create', 'create')->name('kelurahan.create');
            Route::get('kelurahan/edit/{id}', 'edit')->name('kelurahan.edit');
            Route::post('kelurahan/store', 'store');
            Route::get('kelurahan/kecamatanId/{id}', 'kelByKec');
            Route::delete('kelurahan/destroy/{id}', 'destroy');
            Route::post('kelurahan/import', 'import');
            Route::get('kelurahan/export', 'export')->name('kelurahan.export');
        });
        // kecamatan
        Route::controller(KecamatanController::class)->group(function () {
            Route::get('kecamatan', 'index')->name('kecamatan.index');
            Route::get('kecamatan/create', 'create')->name('kecamatan.create');
            Route::get('kecamatan/edit/{id}', 'edit')->name('kecamatan.edit');
            Route::post('kecamatan/store', 'store');
            Route::delete('kecamatan/destroy/{id}', 'destroy');
        });
        // kategori
        Route::controller(KategoriController::class)->group(function () {
            Route::get('kategori', 'index')->name('kategori.index');
            Route::get('kategori/create', 'create')->name('kategori.create');
            Route::get('kategori/edit/{id}', 'edit')->name('kategori.edit');
            Route::post('kategori/store', 'store');
            Route::delete('kategori/destroy/{id}', 'destroy');
        });
    });

    // r24
    Route::controller(R24Controller::class)->group(function () {
        Route::get('r24/edit/{id}', 'edit')->name('r24.edit');
        Route::post('r24/store', 'store');
    });

    // user
    Route::controller(UserController::class)->group(function () {
        Route::get('profil/edit/{username}', 'edit')->name('profile.edit');
        Route::post('profil/store', 'store');
    });
});




// require base_path('routes/api.php');
require __DIR__ . '/auth.php';