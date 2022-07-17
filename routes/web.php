<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\R24Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
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

    // drainase2022
    Route::controller(Drainase2022Controller::class)->group(function () {
        Route::get('datamaster/drainase2022', 'index')->name('drainase2022.index');
        Route::get('datamaster/drainase2022/create', 'create')->name('drainase2022.create');
        // Route::get('datamaster/penduduk/edit/{id}', 'edit')->name('penduduk.edit');
        Route::post('datamaster/drainase2022/store', 'store');
        Route::delete('datamaster/drainase2022/destroy/{id}', 'destroy');

        Route::get('datamaster/drainase2022/export', 'export')->name('drainase2022.export');
        Route::post('datamaster/drainase2022/import', 'import');
    });

    // genangan
    Route::controller(GenanganController::class)->group(function () {
        Route::get('datamaster/genangan', 'index')->name('genangan.index');

        // Route::get('datamaster/drainase2022/create', 'create')->name('drainase2022.create');

        // Route::get('datamaster/penduduk/edit/{id}', 'edit')->name('penduduk.edit');
        // Route::post('datamaster/penduduk/simpan', 'store');

        // Route::delete('datamaster/drainase2022/destroy/{id}', 'destroy');

        // Route::get('datamaster/penduduk/show/{nik}', 'show')->name('penduduk.show');
        // Route::get('datamaster/penduduk/export/{format}', 'export')->name('penduduk.export');
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


require __DIR__ . '/auth.php';