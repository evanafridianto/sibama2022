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
use App\Http\Controllers\Drainase2020Controller;
use App\Http\Controllers\Drainase2022Controller;
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

    // drainase
    Route::group(['prefix' => 'drainase'], function () {
        Route::controller(Drainase2020Controller::class)->group(function () {
            //2020
            Route::get('2020', 'index')->name('drainase2020.index');
            Route::get('2020/create', 'create')->name('drainase2020.create');
            Route::get('2020/edit/{id}', 'edit')->name('drainase2020.edit');
            Route::post('2020/store', 'store');
            Route::delete('2020/destroy/{id}', 'destroy');
            Route::get('2020/export', 'export')->name('drainase2020.export');
            Route::post('2020/import', 'import');
        });

        Route::controller(Drainase2022Controller::class)->group(function () {
            //2022
            Route::get('2022', 'index')->name('drainase2022.index');
            Route::get('2022/create', 'create')->name('drainase2022.create');
            Route::get('2022/edit/{id}', 'edit')->name('drainase2022.edit');
            Route::post('2022/store', 'store');
            Route::delete('2022/destroy/{id}', 'destroy');
            Route::get('2022/export', 'export')->name('drainase2022.export');
            Route::post('2022/import', 'import');
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
    });

    Route::group(['prefix' => 'datamaster'], function () {

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